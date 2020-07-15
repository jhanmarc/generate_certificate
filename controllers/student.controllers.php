<?php
include ('models/student.models.php');

class studentControllers{

    public function generateSudent(){
        if(isset($_POST['studentId']) && isset($_POST['courseId']) && isset($_POST['name_student']) ){
            $data = array(
                'name_student' => $_POST['name_student'],
                'studentId' => $_POST['studentId'],
                'courseId' => $_POST['courseId']
            );
            $resp = studentModels::generateStudent($data);
            return $resp;
        }
    }

    public function getStudentCourse(){
        if(isset($_POST['studentId']) || isset($_POST['courseId']) ){
            $data = array(
                'studentId' => $_POST['studentId'],
                'courseId' => $_POST['courseId']
            );
            $resp = studentModels::getStudentCourse($data);
            $array = array(
                'data_certificate' => $data,
                'resp' => $resp
            );
            return $array;
        }
    }

    public function getStudent(){
        $resp = studentModels::getStudent();
        return $resp;
    }

    public function getCourse(){
        $resp = studentModels::getCourse();
        return $resp;
    }

}

?>