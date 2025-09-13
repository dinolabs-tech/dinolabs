 <script>
        function updatePlaceholders() {
            var category = document.getElementById("category").value;
            var total_students_label = document.querySelector('label[for="total_students"]');
            var amount_per_student_label = document.querySelector('label[for="amount_per_student"]');
            var total_students_input = document.getElementById("total_students");
            var amount_per_student_input = document.getElementById("amount_per_student");

            if (category === "eduhive") {
                total_students_label.textContent = "Total Students:";
                amount_per_student_label.textContent = "Amount Per Student:";
                total_students_input.placeholder = "Total students";
                amount_per_student_input.placeholder = "Amount per student";
            } else if (category === "salesvantage") {
                total_students_label.textContent = "Total Products:";
                amount_per_student_label.textContent = "Amount Per Product:";
                total_students_input.placeholder = "Total products";
                amount_per_student_input.placeholder = "Amount per product";
            } else if (category === "rxpulse") {
                total_students_label.textContent = "Total Drugs:";
                amount_per_student_label.textContent = "Amount Per Drug:";
                total_students_input.placeholder = "Total drugs";
                amount_per_student_input.placeholder = "Amount per drug";
            }
        }

        function calculateTotal() {
            var total_students = document.getElementById("total_students").value;
            var amount_per_student = document.getElementById("amount_per_student").value;

            if (isNaN(total_students) || isNaN(amount_per_student)) {
                document.getElementById("total_amount").value = "";
                return;
            }

            var total_amount = total_students * amount_per_student;
            document.getElementById("total_amount").value = total_amount;
        }

        window.onload = updatePlaceholders;
        $(document).ready(function() {
            $('#clientsTable').DataTable();
        });
    </script>