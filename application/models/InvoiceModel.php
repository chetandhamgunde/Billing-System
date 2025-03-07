<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InvoiceModel extends CI_Model
{

    public function CreateInvoice($data)
    {
        
        // Extract only invoice fields, ignoring any arrays
        $invoiceData = [
            'bill_no'      => $data['bill_no'],
            'waiter_name'  => $data['waiter_name'],
            'total_amount' => $data['total_amount'],
            'discount'     => $data['discount'],
            'cgst'         => $data['cgst'],
            'sgst'         => $data['sgst'],
            'final_amount' => $data['final_amount'],
            
        ];

        // Insert invoice details and return the ID
        $this->db->insert('invoices', $invoiceData);
        return $this->db->insert_id();
    }


    public function AddInvoiceTable($invoice_id, $table_ids)
    {
        // Insert multiple tables for a single invoice
        foreach ($table_ids as $table_id) {
            $this->db->insert('invoice_tables', [
                'invoice_id' => $invoice_id,
                'table_id' => $table_id
            ]);
        }
    }

    public function AddInvoiceItems($invoice_id, $items)
    {
        // Insert ordered items for the invoice
        foreach ($items as $item) {
            $this->db->insert('invoice_items', [
                'invoice_id' => $invoice_id,
                'menu_id'    => $item['menu_id'],
                'quantity'   => $item['quantity'],
                'item_price' => $item['item_price'],
                'total_price' => $item['total_price']
            ]);
        }
    }


    public function GetInvoicesBetweenDates($from_date, $to_date)
{
    $query = $this->db->query(
        "SELECT 
            DATE_FORMAT(i.invoice_date, '%b %y') AS month, 
            SUM(i.total_amount) AS taxable_amount,
            SUM(i.cgst) AS cgst_amount,
            SUM(i.sgst) AS sgst_amount,
            SUM(i.final_amount) AS gross_amount
         FROM invoices i
         WHERE i.invoice_date BETWEEN ? AND ?
         GROUP BY DATE_FORMAT(i.invoice_date, '%b %y')
         ORDER BY i.invoice_date",
        [$from_date, $to_date]
    );

    return $query->result_array();
}

}
