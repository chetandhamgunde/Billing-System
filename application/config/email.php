<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol']    = 'smtp';
$config['smtp_host']   = 'smtp.gmail.com';
$config['smtp_port']   = 587;
$config['smtp_user']   = 'shubhambhapkar0@gmail.com';  // Replace with your email
$config['smtp_pass']   = 'uyzw dsth uiud einp';        // Use your app-specific password
$config['smtp_crypto'] = 'tls';                        // Use 'tls' for secure connection
$config['mailtype']    = 'html';                       // Options: 'text' or 'html'
$config['charset']     = 'utf-8';
$config['newline']     = "\r\n";                       // Ensure newlines are set correctly
$config['smtp_timeout'] = 10;                          // Timeout in seconds
$config['validation']  = TRUE;                         // Email validation (TRUE/FALSE)
