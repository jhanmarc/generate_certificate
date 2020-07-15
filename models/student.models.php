<?php
require('config/database.php');

class studentModels {

    public function generateStudent($data){
        $name_student = $data['name_student'];
        $userId = $data['studentId'];
        $courseId = $data['courseId'];
        $sql = "INSERT INTO certificates (student_id, course_id, create_date) VALUES ('$userId', '$courseId', CURDATE())";
        $cn = Conexion::getConnection();
        $stm = mysqli_query($cn, $sql);
        if($stm){
            mkdir("storage/".$name_student, 0700);
            $resp = array(
                'status' => true,
                'message' => 'Certificado generado'
            );
            return $resp;
        }else{
            $resp = array(
                'status' => false,
                'message' => 'Ups error'
            );
            return $resp;
        }
    }

    public function getStudentCourse($data){
        $userId = $data['studentId'];
        $courseId = $data['courseId'];
        $sql_student = "SELECT * FROM students WHERE id = $userId ";
        $sql_course = "SELECT * FROM courses WHERE id = $courseId ";
        $cn_student = Conexion::getConnection();
        $stm_student = mysqli_query($cn_student, $sql_student);
        $cn_course = Conexion::getConnection();
        $stm_course = mysqli_query($cn_course, $sql_course);
        $resp = array(
            'student' => $stm_student,
            'course' => $stm_course
        );
        return $resp;
    }

    public function getStudent(){
        $sql = "SELECT * FROM students";
        $cn_student = Conexion::getConnection();
        $stm_student = mysqli_query($cn_student, $sql);
        return $stm_student;
    }

    public function getCourse(){
        $sql = "SELECT * FROM courses";
        $cn_course = Conexion::getConnection();
        $stm_course = mysqli_query($cn_course, $sql);
        return $stm_course;
    }

}

?>