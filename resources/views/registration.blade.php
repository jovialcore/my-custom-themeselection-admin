<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form - Automated Pros</title>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <style>
    #loading-spinner {
      display: none;
    }
  </style>
</head>
<body>

  <h1>Registration Form Automated Pros</h1>

  <form id="registrationForm">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Register</button>
  </form>

  <h2>Registered Users</h2>

  <table id="usersTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script>
    $(document).ready(function() {
     
      var usersTable = $('#usersTable').DataTable();

    
      $.ajax({
        url: '/get-users',
        type: 'GET',
        success: function(response) {
         
          $.each(response.users, function(index, user) {
            usersTable.row.add([user.name, user.email]).draw();
          });
        }
      });

  
      $('#registrationForm').submit(function(event) {
        event.preventDefault();

        $.ajax({
          url: '/register',
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
        
            $('#registrationForm')[0].reset();
       
            usersTable.row.add([response.user.name, response.user.email]).draw();
          }
        });
      });
    });
  </script>

</body>
</html>
