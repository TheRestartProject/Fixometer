<?php

    class File extends Model {
        
        public $path;
        public $file;
        
        protected $table;
        
        /**
         * receives the POST data from an HTML form
         * processes file upload and saves
         * to database, depending on filetype
         * */
        
        public function upload($file, $type, $reference = null, $referenceType = null){
            $user_file = $_FILES[$file];
            
            
            /** if we have no error, proceed to elaborate and upload **/
            if($user_file['error'] == UPLOAD_ERR_OK){
                $filename = $this->filename($user_file);
                $this->file = $filename;
                $path = DIR_UPLOADS . DS . $filename;
                if(!move_uploaded_file($user_file['tmp_name'], $path)){
                    return false;
                }
                else {
                    $data = array();
                    $this->path = $path;
                    $data['path'] = $this->file;
                    
                    if($type === 'image'){  
                        $size = getimagesize($this->path);
                        $data['width']  = $size[0];
                        $data['height'] = $size[1];
                        
                        $this->table = 'images';
                        
                        $image = $this->create($data);
                        
                        if(is_numeric($image) && !is_null($reference) && !is_null($referenceType)){
                            $xref = new Xref('object', $image, TBL_IMAGES, $reference, $referenceType);
                            $xref->createXref();                            
                        }
                    }
                    
                }
                
            }
            /** else, we raise exceptions and errors! **/
            else {
                
            }
            
        }
        
        /**
         * generates filename and maintains
         * correct file extension
         * (MIME check with Finfo!)
         * */
        public function filename($file){
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $ext = array_search(
                $finfo->file($file['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ),
                true);
            
            if(empty($ext) || !$ext || is_null($ext)) {
                return false;
            }
            
            else {
                $filename = sha1_file($file['tmp_name']) . '.' . $ext;
                return $filename;
            }
            
        
        }
    }
    