<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Chat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  
  <body>
    <main>
      <header>
        <div onclick="changeUser();" class="user"></div>
        <h1>Chat</h1>
      </header>

      <div class="chat" style="overflow-y: scroll; overflow-x: hidden;">
        <p><strong>Test1</strong>: Hello</p>
        <p><strong>Test2</strong>: Hi</p>
      </div>

      <form onsubmit="send();" onkeypress="return event.keyCode!=13">
        <input id="message" type="text" placeholder="Say something nice" />
        <button type="button" onclick="send();">Send</button>
      </form>
    </main>
    
    <?php include "server-logic.php";?>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script>
      var user = localStorage.getItem("user");
      if (!user) {
        user = prompt("Choose a username");
        if (isNullOrEmpty(user)) {
          user = "Guest"
        }
        user = user.substring(0, 10);
        localStorage.setItem("user", user);
      }
      document.getElementsByClassName("user")[0].innerHTML = user;
      
      function changeUser() {
        user = prompt("Choose a username");
        if (isNullOrEmpty(user)) {
          user = "Guest"
        }
        user = user.substring(0, 10);
        localStorage.setItem("user", user);
        document.getElementsByClassName("user")[0].innerHTML = user;
      }
      
      function send() {
        var msgBox = document.getElementById("message");
        var msg = msgBox.value;
        var chat = document.getElementsByClassName("chat")[0];
        if (!isNullOrEmpty(msg)) {
          chat.innerHTML += "<p><strong>" + user + "</strong>: " + msg + "</p>";
          msgBox.value = "";
          chat.scrollTop = chat.scrollHeight;
        }
      }
      
      document.getElementById("message").onkeyup = function(e) {
        if (e.key === "Enter") {
          send();
        }
      }
      
      function isNullOrEmpty(str) {
        return !str || !str.trim();
      }
    </script>
  </body>
</html>