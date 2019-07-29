 <?php 
if( ! empty($download_file))
    {
        //If you want to download an existing file from your server you'll need to read the file into a string
         $data = file_get_contents($download_file); // Read the file's contents
         $name = $download_file;
         $currentSection = explode("/",$name);
         $currentSection = end($currentSection);
         $name = DOMAIN_NAME.'/'. $currentSection;
         force_download($name, $data);
    }
 ?>