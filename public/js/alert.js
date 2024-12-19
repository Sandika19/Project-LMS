// Template Warning Alert
function warningAlert({ title = "Confirmation", text = "Are you sure?", icon = "warning", confirmButtonText = "Confirm", cancelButtonText = "Cancel", reverseButtons = true, element }) {
   element.addEventListener("submit", (e) => {
      e.preventDefault();

      Swal.fire({
         title,
         text,
         icon,
         showCancelButton: true,
         confirmButtonText,
         cancelButtonText,
         reverseButtons,
      }).then((result) => {
         if (result.isConfirmed) {
            element.submit();
         }
      });
   });
}

// Template Success Alert
function successAlert(text) {
   Swal.fire({
      title: "Success!",
      text,
      icon: "success",
   });
}

// No Class Alert
function noClassAlert(text) {
   Swal.fire({
      title: "No Class Assigned",
      text,
      icon: "error",
   });
}

// Already Enrolled
function rejectAlert(text) {
   Swal.fire({
      title: "Oops...",
      text,
      icon: "error",
   });
}

// Confirmation Update Student Profile
const updateProfileForm = document.getElementById("update-profile-form");
if (updateProfileForm) {
   warningAlert({
      title: "Double Check Your Information",
      text: "Do you want to continue with the updates to your profile?",
      confirmButtonText: "Update",
      element: updateProfileForm,
   });
}

// Confirmation Complete Student Profile
const completeProfileForm = document.getElementById("complete-profile-form");
if (completeProfileForm) {
   warningAlert({
      title: "Confirm Your Information",
      text: "Please confirm that your profile information is correct before proceeding.",
      confirmButtonText: "Complete",
      element: completeProfileForm,
   });
}

// Logout
const logoutForm = document.getElementById("logout-form");
if (logoutForm) {
   logoutForm.addEventListener("submit", (e) => {
      e.preventDefault();

      Swal.fire({
         title: "Leaving so soon?",
         text: "We'll miss you! Don't forget to come back soon",
         icon: "warning",
         showCancelButton: true,
         confirmButtonText: "Logout",
         confirmButtonColor: "#4A5B92",
         reverseButtons: true,
         cancelButtonText: "Cancel",
      }).then((result) => {
         if (result.isConfirmed) {
            logoutForm.submit();
         }
      });
   });
}

// Complete Profile Alert
function completeProfileAlert(text, role = "") {
   Swal.fire({
      title: "Profile Not Complete",
      text,
      icon: "warning",
      confirmButtonText: "Complete Profile",
      allowOutsideClick: false,
      allowEscapeKey: false,
      allowEnterKey: false,
   }).then((result) => {
      if (result.isConfirmed) {
         // Redirect to the form page
         window.location.href = `${role}/complete-profile`;
      }
   });
}

// Confirmation Create Class
const createClassForm = document.getElementById("create-class-form");
if (createClassForm) {
   warningAlert({
      title: "Verify Your Class Details",
      text: "Please ensure that all the information about your class is correct before submitting.",
      confirmButtonText: "Create",
      element: createClassForm,
   });
}

// Confirmation Delete Class Alert
const deleteClassForm = document.getElementById("delete-class-form");
if (deleteClassForm) {
   warningAlert({
      title: "Are You Sure?",
      text: "Deleting this class will remove all associated data. This action cannot be undone.",
      confirmButtonText: "Delete",
      element: deleteClassForm,
   });
}

// Confirmation Update Class Alert
const updateClassForm = document.getElementById("update-class-form");
if (updateClassForm) {
   warningAlert({
      title: "Update Confirmation",
      text: "Please confirm if you wish to update the class. The changes will be saved permanently.",
      confirmButtonText: "Update",
      element: updateClassForm,
   });
}

// Confirmation Upload Material
const addMaterialForm = document.getElementById("add-material-form");
if (addMaterialForm) {
   warningAlert({
      title: "Ready to Upload?",
      text: "Double-check everything! Once uploaded, the material will be shared with your class.",
      confirmButtonText: "Upload",
      element: addMaterialForm,
   });
}

// Confirmation Delete Material Alert
const deleteMaterialForm = document.querySelectorAll(".delete-material-form");
if (deleteMaterialForm) {
   deleteMaterialForm.forEach((deleteMaterial) => {
      warningAlert({
         title: "Are You Sure?",
         text: "Deleting this material will erase all related data forever. This action can't be undone.",
         confirmButtonText: "Delete",
         element: deleteMaterial,
      });
   });
}

// Confirmation Update Material
const updateMaterialForm = document.getElementById("update-material-form");
if (updateMaterialForm) {
   warningAlert({
      title: "Update Confirmation",
      text: "Please confirm if you wish to update the material. The changes will be saved permanently.",
      confirmButtonText: "Update",
      element: updateMaterialForm,
   });
}

// Confirmation Enrollment Class For Student
const enrollForm = document.querySelectorAll(".enroll-form");
if (enrollForm) {
   enrollForm.forEach((enroll) => {
      warningAlert({
         title: "Confirm Enrollment",
         text: "Are you sure you want to enroll in this class? This action cannot be undone.",
         confirmButtonText: "Enroll",
         element: enroll,
      });
   });
}

// Confirmation Submit Assignment Form
const studentAssignmentForm = document.getElementById("student-assignment-form");
if (studentAssignmentForm) {
   warningAlert({
      title: "Submit Assignment",
      text: "Are you sure you want to submit this assignment? Once submitted, you will no longer be able to make changes.",
      confirmButtonText: "Submit",
      element: studentAssignmentForm,
   });
}

// Confirmation Delete Student From Class
const deleteStudentForm = document.querySelectorAll(".delete-student-form");
if (deleteStudentForm) {
   deleteStudentForm.forEach((deleteStudent) => {
      warningAlert({
         title: "Are You Sure?",
         text: "Deleting this student will remove all their data permanently. This action is irreversible.",
         confirmButtonText: "Delete",
         element: deleteStudent,
      });
   });
}

const studentList = document.querySelector("#unenrolled-student-list");
if (studentList) {
   studentList.addEventListener("submit", function (e) {
      if (e.target.classList.contains("enroll-student-form")) {
         e.preventDefault();
         warningAlert({
            title: "Confirm Enrollment",
            text: "You are about to enroll this student into your class. They will gain access to all related materials. Do you want to continue?",
            confirmButtonText: "Enroll",
            element: e.target,
         });
      }
   });
}
