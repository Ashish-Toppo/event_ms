<?php 

    // function to get the url of the website
    function get_main_url () :string {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   $url = "https://";   
        
        else  $url = "http://";  
                 
        // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];    
            
        return $url;
    }


    // function to get current specific url with the uri
    function get_current_url () :string {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   $url = "https://";   
        
            else  $url = "http://";  
                     
            // Append the host(domain name, ip) to the URL.   
            $url.= $_SERVER['HTTP_HOST'];   
            
            // Append the requested resource location to the URL   
            $url.= $_SERVER['REQUEST_URI'];    
                
            return $url;
    }