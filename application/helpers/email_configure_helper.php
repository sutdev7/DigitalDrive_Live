<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if(!function_exists('sendGridEMail')){
    function sendGridEMail($from,$to,$cc="",$bcc="",$subject,$message,$attachment="",$attachment_name=""){
        $CI = & get_instance();
        $config['useragent']    = "CodeIgniter";
        $config['mailpath']     = "/usr/sbin/sendmail";
        $config['protocol']     = 'smtp';
        //$config['protocol']   = 'mail';
        $config['smtp_host']    = 'ssl://smtp.sendgrid.net';
        //$config['smtp_host']    = 'smtp.sendgrid.net';
        //$config['smtp_user']  = 'h_M4xbz7SfWztc0V4WqaOA';
        //$config['smtp_pass']  = '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';
        //$config['smtp_user']  = 'W7uk4GCvSoOQgSIzC9hEiA',    Old New User
        //$config['smtp_pass']  = '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',   Old New Pass
        $config['smtp_user']    = 'ok4KlbRaTreCjeJdXiSFiQ';
        //$config['smtp_user']    = 'apikey';
        $config['smtp_pass']    = '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';
        $config['smtp_port']    = '465';       
        //$config['smtp_port']    = '587';
        $config['smtp_timeout'] = '5';  
        $config['smtp_crypto']  = '';  
        $config['wordwrap']     = TRUE;   
        $config['wrapchars']    = '76';   
        $config['mailtype']     = 'html';
        $config['charset']      = 'utf-8';
        $config['multipart']    = 'mixed';
        $config['alt_message']  = '';
        $config['validate']     = FALSE;
        $config['priority']     = '3';
        $config['newline']      = "\n";
        //$config['newline']      = "\r\n";
        $config['crlf']         = "\n";
        //$config['crlf']         = "\r\n";
        $config['send_multipart'] = TRUE;
        $config['bcc_batch_mode'] = FALSE;
        $config['bcc_batch_mode'] = 200;

        $CI->email->initialize($config);
        $CI->email->from($from);        
        $CI->email->to($to);

        if(!empty($cc) && is_array($cc)){
            foreach ($cc as $ccemail) {
                $CI->email->cc($ccemail);
            }
        } else{
            $CI->email->cc($cc);
        }

        if(!empty($bcc) && is_array($bcc)){
            foreach ($bcc as $bccemail) {
                $CI->email->bcc($bccemail);
            }
        } else{
            $CI->email->bcc($bcc);
        }
        
        $CI->email->subject($subject);
        $CI->email->message($message); 
        if($CI->email->send()){
            show_error($CI->email->print_debugger());
            return true;
        }else{
            show_error($CI->email->print_debugger());
            return false;
        }
    }
}