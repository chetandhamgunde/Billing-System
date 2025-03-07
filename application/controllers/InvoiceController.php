<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InvoiceController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('InvoiceModel');
    }

    public function CreateInvoice()
    {
        // Set content type to JSON
        header('Content-Type: application/json');

        // Get raw POST data
        $postData = json_decode(file_get_contents("php://input"), true);

        // Debugging: Check received data
        // file_put_contents('debug_log.txt', print_r($postData, true));

        if (!$postData) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
            http_response_code(400); // Bad Request
            return;
        }

        // Validate required fields
        if (
            empty($postData['bill_no']) || empty($postData['waiter_name']) || empty($postData['total_amount']) ||
            !isset($postData['discount']) || !isset($postData['cgst']) || !isset($postData['sgst']) || empty($postData['final_amount'])
        ) {

            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            http_response_code(400); // Bad Request
            return;
        }

        // Insert invoice and get the generated ID
        $invoice_id = $this->InvoiceModel->CreateInvoice($postData);

        if ($invoice_id) {
            // Add tables associated with the invoice
            if (!empty($postData['table_ids'])) {
                $table_ids = is_array($postData['table_ids']) ? $postData['table_ids'] : explode(',', $postData['table_ids']);
                $this->InvoiceModel->AddInvoiceTable($invoice_id, $table_ids);
            }

            // Add ordered items
            if (!empty($postData['items'])) {
                // Ensure `items` is properly decoded
                $items = is_array($postData['items']) ? $postData['items'] : json_decode($postData['items'], true);

                if (!is_array($items)) {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid items format']);
                    http_response_code(400); // Bad Request
                    return;
                }

                // Debugging: Log the items before inserting
                // file_put_contents('debug_log.txt', "Items: " . print_r($items, true), FILE_APPEND);

                $this->InvoiceModel->AddInvoiceItems($invoice_id, $items);
            }

            $response = ['status' => 'success', 'message' => 'Invoice created successfully', 'invoice_id' => $invoice_id];
            http_response_code(201); // Created
        } else {
            $response = ['status' => 'error', 'message' => 'Failed to create invoice'];
            http_response_code(500); // Internal Server Error
        }

        echo json_encode($response);
    }

    public function GetRevenueData()
    {
        $this->load->database();

        // Fetch revenue data for today (6 AM - 12 PM grouped by 3 hours)
        $todayData = $this->db->select("HOUR(invoice_date) as hour, SUM(final_amount) as total")
            ->where('DATE(invoice_date)', date('Y-m-d'))
            ->where('HOUR(invoice_date) >=', 6)
            ->where('HOUR(invoice_date) <', 12) // Only 6 AM - 12 PM
            ->group_by('HOUR(invoice_date)')
            ->get('invoices')->result_array();

        $todayRevenue = [
            '12-3 AM' => 0,
            '3-6 AM' => 0,
            '6-9 AM' => 0,
            '9-12 PM' => 0,
            '12-3 PM' => 0,
            '3-6 PM' => 0,
            '6-9 PM' => 0,
            '9-12 AM' => 0
        ];

        foreach ($todayData as $data) {
            $hour = (int) $data['hour'];

            if ($hour >= 0 && $hour < 3) {
                $todayRevenue['12-3 AM'] += (float) $data['total'];
            } elseif ($hour >= 3 && $hour < 6) {
                $todayRevenue['3-6 AM'] += (float) $data['total'];
            } elseif ($hour >= 6 && $hour < 9) {
                $todayRevenue['6-9 AM'] += (float) $data['total'];
            } elseif ($hour >= 9 && $hour < 12) {
                $todayRevenue['9-12 PM'] += (float) $data['total'];
            } elseif ($hour >= 12 && $hour < 15) {
                $todayRevenue['12-3 PM'] += (float) $data['total'];
            } elseif ($hour >= 15 && $hour < 18) {
                $todayRevenue['3-6 PM'] += (float) $data['total'];
            } elseif ($hour >= 18 && $hour < 21) {
                $todayRevenue['6-9 PM'] += (float) $data['total'];
            } elseif ($hour >= 21 && $hour < 24) {
                $todayRevenue['9-12 AM'] += (float) $data['total'];
            }
        }
        // Fetch weekly revenue
        $weeklyData = $this->db->select("LEFT(DAYNAME(invoice_date), 3) as day, SUM(final_amount) as total")
            ->where('YEARWEEK(invoice_date, 1) = YEARWEEK(CURDATE(), 1)')
            ->group_by('DAYOFWEEK(invoice_date)')
            ->order_by('DAYOFWEEK(invoice_date)')
            ->get('invoices')->result_array();

        $weekDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $weeklyRevenue = array_fill_keys($weekDays, 0);
        foreach ($weeklyData as $data) {
            $weeklyRevenue[$data['day']] = (float) $data['total'];
        }

        // Fetch monthly revenue
        $monthlyData = $this->db->select("WEEK(invoice_date, 1) as week, SUM(final_amount) as total")
            ->where('MONTH(invoice_date)', date('m'))
            ->where('YEAR(invoice_date)', date('Y'))
            ->group_by('WEEK(invoice_date, 1)')
            ->order_by('WEEK(invoice_date, 1)')
            ->get('invoices')->result_array();

        $monthlyRevenue = ['Week 1' => 0, 'Week 2' => 0, 'Week 3' => 0, 'Week 4' => 0, 'Week 5' => 0];

        foreach ($monthlyData as $data) {
            $weekIndex = min((int) $data['week'], 5); // Ensure max is "Week 5"
            $monthlyRevenue["Week $weekIndex"] += (float) $data['total'];
        }


        // Fetch yearly revenue
        $yearlyData = $this->db->select("MONTH(invoice_date) as month, SUM(final_amount) as total")
            ->where('YEAR(invoice_date)', date('Y'))
            ->group_by('MONTH(invoice_date)')
            ->order_by('MONTH(invoice_date)')
            ->get('invoices')->result_array();

        $yearlyRevenue = array_fill(1, 12, 0);
        foreach ($yearlyData as $data) {
            $yearlyRevenue[$data['month']] = (float) $data['total'];
        }

        // Single JSON response
        echo json_encode([
            'Today' => array_values($todayRevenue),
            'Weekly' => array_values($weeklyRevenue),
            'Monthly' => array_values($monthlyRevenue),
            'Yearly' => array_values($yearlyRevenue)
        ]);
    }


    public function GetInvoicesByDateRange()
    {
        // Load the model
        $this->load->model('InvoiceModel');

        // Get raw POST data
        $post_data = json_decode(file_get_contents("php://input"), true);

        // Extract dates
        $from_date = $post_data['from_date'] ?? null;
        $to_date = $post_data['to_date'] ?? null;

        // Validate input
        if (!$from_date || !$to_date) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode(['error' => 'Both from_date and to_date are required.']));
            return;
        }

        // Fetch summarized sales data
        $sales_summary = $this->InvoiceModel->GetInvoicesBetweenDates($from_date, $to_date);

        // Calculate total summary
        $total_taxable = $total_cgst = $total_sgst = $total_gross = 0;
        foreach ($sales_summary as $row) {
            $total_taxable += $row['taxable_amount'];
            $total_cgst += $row['cgst_amount'];
            $total_sgst += $row['sgst_amount'];
            $total_gross += $row['gross_amount'];
        }

        // Append total row
        $sales_summary[] = [
            'month' => 'Total',
            'taxable_amount' => $total_taxable,
            'cgst_amount' => $total_cgst,
            'sgst_amount' => $total_sgst,
            'gross_amount' => $total_gross
        ];

        // Return JSON response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => 'success', 'data' => $sales_summary]));
    }
}
