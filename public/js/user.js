// == NAVBAR ==
const profileBtn = document.querySelector("#profile-btn");
const popUpProfile = document.querySelector("#pop-up-profile");

if (profileBtn) {
   profileBtn.addEventListener("click", (e) => {
      profileBtn.classList.toggle("profile-active");
   });

   document.addEventListener("click", (e) => {
      if (!popUpProfile.contains(e.target) && !profileBtn.contains(e.target)) {
         profileBtn.classList.remove("profile-active");
      }
   });
}
// != NAVBAR =!

// == SIDEBAR ==
const toggleSidebarBtn = document.querySelector("#toggle-sidebar-btn");

if (toggleSidebarBtn) {
   toggleSidebarBtn.addEventListener("click", function (e) {
      document.body.classList.toggle("toggle-sidebar");
   });
}
// != SIDEBAR =!

// == CALENDAR ==
function generateCalendar(year, month) {
   const calendarElement = document.getElementById("calendar");
   const currentMonthElement = document.getElementById("currentMonth");

   if (calendarElement) {
      // Create a date object for the first day of the specified month
      const firstDayOfMonth = new Date(year, month, 1);
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      // Clear the calendar
      calendarElement.innerHTML = "";

      // Set the current month text
      const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      currentMonthElement.innerText = `${monthNames[month]} ${year}`;

      // Calculate the day of the week for the first day of the month (0 - Sunday, 1 - Monday, ..., 6 - Saturday)
      const firstDayOfWeek = firstDayOfMonth.getDay();

      // Create headers for the days of the week
      const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
      daysOfWeek.forEach((day) => {
         const dayElement = document.createElement("div");
         dayElement.className = "text-center sm:p-3 py-3 px-0 font-semibold bg-[#D4DDF9] rounded-md";
         dayElement.innerText = day;
         calendarElement.appendChild(dayElement);
      });

      // Create empty boxes for days before the first day of the month
      for (let i = 0; i < firstDayOfWeek; i++) {
         const emptyDayElement = document.createElement("div");
         calendarElement.appendChild(emptyDayElement);
      }

      // Create boxes for each day of the month
      for (let day = 1; day <= daysInMonth; day++) {
         const dayElement = document.createElement("div");
         dayElement.className = "text-center py-3 rounded-md border cursor-pointer hover:bg-slate-300";
         dayElement.innerText = day;

         // Check if this date is the current date
         const currentDate = new Date();
         if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
            dayElement.classList.add("bg-[#4A5B92]", "text-white"); // Add classes for the indicator
         }

         calendarElement.appendChild(dayElement);
      }
   }
}

// Initialize the calendar with the current month and year
const currentDate = new Date();
let currentYear = currentDate.getFullYear();
let currentMonth = currentDate.getMonth();
generateCalendar(currentYear, currentMonth);

const prevMonth = document.getElementById("prevMonth");
const nextMonth = document.getElementById("nextMonth");

if (prevMonth && nextMonth) {
   // Event listeners for previous and next month buttons
   prevMonth.addEventListener("click", () => {
      currentMonth--;
      if (currentMonth < 0) {
         currentMonth = 11;
         currentYear--;
      }
      generateCalendar(currentYear, currentMonth);
   });

   nextMonth.addEventListener("click", () => {
      currentMonth++;
      if (currentMonth > 11) {
         currentMonth = 0;
         currentYear++;
      }
      generateCalendar(currentYear, currentMonth);
   });
}
// != CALENDAR =!

// == THUMBNAIL CLASS ==
const radioThumbnail = document.querySelectorAll("[name=upload-thumbnail]");
const thumbnailSection = document.getElementById("thumbnail-class");

if (radioThumbnail && thumbnailSection) {
   radioThumbnail.forEach((radio, i) => {
      radio.addEventListener("change", (e) => {
         if (e.target.id === "upload-new-thumbnail") {
            thumbnailSection.classList.remove("hidden");
            thumbnailSection.setAttribute("required", "");
         } else {
            thumbnailSection.classList.add("hidden");
            thumbnailSection.removeAttribute("required");
         }
      });
   });
}
// != THUMBNAIL CLASS =!

// == ADD CONTENT BUTTON ==
const addContentButton = document.getElementById("addContentButton");
const dropdown = document.getElementById("dropdownAddContent");

if (addContentButton && dropdown) {
   addContentButton.addEventListener("click", (e) => {
      e.stopPropagation();
      if (dropdown.classList.contains("invisible")) {
         dropdown.classList.remove("invisible");
      } else {
         dropdown.classList.add("invisible");
      }
   });

   // Close dropdown
   document.addEventListener("click", (e) => {
      if (!addContentButton.contains(e.target) && !dropdown.contains(e.target)) {
         dropdown.classList.add("invisible");
      }
   });
}
// != ADD CONTENT BUTTON =!

// == FOOTER ==
const footerSection = document.getElementById("footer");

function adjustFooterPosition() {
   // Memeriksa apakah scroll bar muncul
   if (document.body.scrollHeight <= window.innerHeight) {
      // Jika tidak ada scrollbar, buat footer tetap di bawah
      footerSection.classList.add("sticky-at-bottom");
   } else {
      // Jika ada scrollbar, hapus sticky class
      footerSection.classList.remove("sticky-at-bottom");
   }
}

// Panggil fungsi saat halaman dimuat dan saat ukuran jendela berubah
window.addEventListener("load", adjustFooterPosition);
window.addEventListener("resize", adjustFooterPosition);
// == FOOTER =!

// == STUDENT CLASSES ==
const majorSelect = document.getElementById("major-select-class");
const radioButtons = document.querySelectorAll("[name='level']");

if (majorSelect) {
   majorSelect.addEventListener("change", (e) => {
      const selectedValue = e.target.value;
      if (selectedValue) {
         window.location.href = `/classes?major=${selectedValue}`;
      }
   });

   radioButtons.forEach((radio) => {
      radio.addEventListener("change", () => {
         const level = radio.value;
         const params = new URLSearchParams(window.location.search);
         params.set("level", level);
         window.location.href = `${window.location.pathname}?${params.toString()}`;
      });
   });
}
// != STUDENT CLASSES =!

// == DELETE STUDENT FROM CLASS ==
const deleteStudentBtn = document.querySelectorAll(".delete-student-btn");
const deleteStudentForms = document.querySelectorAll(".delete-student-form");

if (deleteStudentBtn) {
   deleteStudentBtn.forEach((btn, i) => {
      btn.addEventListener("click", () => {
         deleteStudentForms[i].classList.toggle("hidden");
      });

      document.addEventListener("click", (e) => {
         if (!e.target.closest(".delete-student-btn")) {
            deleteStudentForms.forEach((form) => {
               form.classList.add("hidden");
            });
         }
      });
   });
}
// != DELETE STUDENT FROM CLASS =!

// == GET DATA UNENROLLED STUDENTS ==
$(document).ready(function () {
   let classId = $("#container").data("class-id");
   let studentList = $("#unenrolled-student-list");

   if (classId) {
      $.ajaxSetup({
         headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
         },
      });

      $("#loading-row").removeClass("hidden");

      $.ajax({
         type: "GET",
         url: `/api/teacher/classes/${classId}/people`,
         data: {},
         dataType: "json",
         success: function ({ data }) {
            if (data.length != 0) {
               $.each(data, function (i, data) {
                  $("#loading-row").addClass("hidden");
                  studentList.append(`
                  <tr>
                     <td>${i + 1}</td>
                     <td>${data.student.fullname}</td>
                     <td>${data.student.nis}</td>
                     <td>${numberToRoman(data.student.grade)}</td>
                     <td>${data.student.major.toUpperCase()}</td>
                     <td>
                        <form action="/teacher/classes/${classId}/${data.id}/enrollment" method="POST" class="enroll-student-form">
                           <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr("content")}">
                           <button type="submit" class="py-2 px-6 font-semibold text-sm bg-[#A9BBF4] rounded-md text-black hover:bg-[#4A5B92] hover:text-white">
                              Enroll
                           </button>
                        </form>
                     </td>
                  </tr>
               `);
               });
            } else {
               $("#loading-row").addClass("hidden");
               studentList.append(`
               <tr>
                  <td colspan="6">
                     <div class="text-center">Data not available</div>
                  </td>
               </tr>
            `);
            }
         },
         error: function (xhr, status, error) {
            console.error("Error:", error);
         },
      });
   }
});

function numberToRoman(num) {
   switch (num) {
      case "10":
         return "X";
      case "11":
         return "XI";
      case "12":
         return "XII";
      default:
         return "";
   }
}

// != GET DATA UNENROLLED STUDENTS =!
