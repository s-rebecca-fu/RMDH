<?php

/**
 * Created by PhpStorm.
 * User: rebec
 * Date: 5/7/2017
 * Time: 1:30 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class story extends Application
{

    //homepage for the "story"
    public function index() {
        $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
        $this->data['user'] = $this->session->userdata('user');
        $this->data["message"] = "welcome to story management system";
        $this->data['records'] = "<div></div>";
        $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
        $this->data['pagebody'] = "management";
        $this->render();
    }

    //get all stories in the database and order by post time desc
    public function getAll() {
        $this->db->from("stories");
        $this->db->order_by("posttime","desc");
        $records =  $this->db->get()->result();
        //$records = $this->stories->sortedByDateTime("desc"); // get all the histories
        $tempstories = array();
        foreach ($records as $story) {
            $tmp_publish="";
            if($story->published == 0) {
                $tmp_publish="<input type='checkbox' name='publish' value='published' />";
            } else {
                $tmp_publish="<input type='checkbox' name='publish' value='published' checked='checked' />";
            }
            $temp_agree ="";
            if($story->agreetoshare == 0) {
                $temp_agree = "NO";
            }else {
                $temp_agree = "YES";
            }
            $temp_image = array();
            $temp_link = array();
            $media_result ="";
            if($story->images!="") {
                $temp_image[] = explode(",",$story->images);
                //var_dump($temp_image);
                foreach ($temp_image[0] as $image) {
                    if($image != "") {
                        $temp = "<img class='img-thumbnail' src='http://4900.onebite.tk/pics/".$image.".png' width='70px' height='70px'/>";
                        array_push($temp_link,$temp);
                    }
                }
                $media_result = implode(" ",$temp_link);
            } else if($story->video != ""){
                $temp_link = $story->video;
                $media_result = "<div class='text-center'><iframe width='300' height='200' src='https://www.youtube.com/embed/".$temp_link."'></iframe></div>";
            }

            $tempstories[] = array(
                'id' => $story->id,
                'reason' => $story->reason,
                'action' => $story->action,
                'group' => $story->groupname,
                'story'=>$story->textstories,
                'publish' => $tmp_publish,
                'media' => $media_result,
                'agreetoshare' => $temp_agree,
                'time' => $story->posttime
            );

        }
        $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
        $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
        $this->data['records'] = $tempstories;
        $this->data['pagebody'] = "showstories";
        $this->render();
    }

    //the edit page for a single story
    public function edit($id){
        $tempArray = $this->stories->getSingleOne($id);
        $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
        $this->data["pagebody"] = "editstory";
        $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
        $this->data = array_merge($this->data, $tempArray);
        $this->render();
    }

    //the function that connect to database, and update things
    public function update(){
        $publishvalue = 0;
        if(isset($_POST['publish']) && $_POST['publish'] == 'published') {
            $publishvalue= 1;
        }
        $temp_agree = 0;
        if($_POST['agree'] == 'YES') {
            $temp_agree = 1;
        }

        $tempstories[] = array(
            //'id' => $_POST['id'],
            'reason' => $_POST['reason'],
            'action' => $_POST['action'],
            'groupname' => $_POST['group'],
            'textstories'=>$_POST['text'],
            'published' =>$publishvalue
            //'agreetoshare' => $_POST['agree'],
            //'posttime' => $_POST['time']
        );

        $this->db->where('id', $_POST['id']);
        for($i=0; $i < sizeof($tempstories);$i++) {
            $this->db->update('stories',$tempstories[$i]);
        }

        $this->getAll();
    }

    //the fuction that delete a single story
    public function delete($id) {
        $this->db->delete('stories', array('id' => $id));
        $this->getAll();
    }

    //delete single image for each story, and update the image attribute in database
    public function imagedelete($id,$image) {
        $temp_result = $this->stories->getAllStories();
        $temp_string ="";
        foreach ($temp_result as $single) {
            if($single->id == $id) {
                $a = ",".$image;

                if (!strpos($single->images,$a)) {
                    $a = $image.",";
                }
                $temp_string = str_replace($a, "", $single->images);
                break;
            }
        }
        $data = array(
            'images' => $temp_string
        );
        $this->db->where('id', $id);
        $this->db->update('stories', $data);
        $this->edit($id);

    }

    //filters: get all records that published or not published
    //if $value = yes , get published
    //if $value = no, get unpublished
    public function published($value) {
        $temp_value ="";
        $tmp_publish="";
        if($value == 'yes') {
            $temp_value = 1;
            $tmp_publish="<input type='checkbox' name='publish' value='published' checked='checked' />";
        } else {
            $temp_value = 0;
            $tmp_publish="<input type='checkbox' name='publish' value='published' />";
        }
        $this->db->from("stories");
        $this->db->order_by("posttime","desc");
        $this->db->where('published',$temp_value);
        $records =  $this->db->get()->result();
        $tempstories = array();
        foreach ($records as $story) {
            $temp_agree ="";
            if($story->agreetoshare == 0) {
                $temp_agree = "NO";
            }else {
                $temp_agree = "YES";
            }
            $temp_image = array();
            $temp_link = array();
            if($story->images!="") {
                $temp_image[] = explode(",",$story->images);
                //var_dump($temp_image);
                foreach ($temp_image[0] as $image) {
                    $temp = "<img class='img-thumbnail' src='http://4900.onebite.tk/pics/".$image.".png' width='70px' height='70px'/>";
                    array_push($temp_link,$temp);
                }
                //echo implode(" ",$temp_link);
            }

            $tempstories[] = array(
                'id' => $story->id,
                'reason' => $story->reason,
                'action' => $story->action,
                'group' => $story->groupname,
                'story'=>$story->textstories,
                'publish' => $tmp_publish,
                'media' => implode(" ",$temp_link),
                'agreetoshare' => $temp_agree,
                'time' => $story->posttime
            );
        }
        $this->data['menubar'] = $this->parser->parse("menubar", $this->data, true);
        $this->data['footer'] = $this->parser->parse('footer', $this->data, true);
        $this->data['records'] = $tempstories;
        $this->data['pagebody'] = "showstories";
        $this->render();
    }
}