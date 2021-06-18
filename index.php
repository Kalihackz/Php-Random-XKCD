<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>XKCD PHP Web Application</title>
    <meta name="description" content="Main Page of PHP Web Application." />
    <meta property="og:site_name" content="XKCD Challenge"/>
    <meta property="og:image" content="https://imgs.xkcd.com/comics/api.png" />
    <meta property="og:locale" content="en_GB" />
    <meta name="referrer" content="origin" />
    <link rel="icon" href="https://imgs.xkcd.com/comics/api.png" type="image/icon type" />
</head>
<body>
    <header>
        <nav>
        <div class="title">XKCD challenge</div>
        <div class="navbar"><ul><li><a class="active" href="/rtcamp/">Home</a></li><li><a href="https://github.com/Kalihackz">Github</a></li><li><a href="https://in.linkedin.com/in/abir-ghosh-b174641ba">LinkedIN</a></li></ul></div>
        </nav>
    </header>
    <main>
      <section>
      <h1 class="header">Welcome to <span style="color:red">ABIR's</span> Random XKCD challenge</h1>
      <?php
          if(isset($_COOKIE['FailedReason']))
          {
      ?>
            <p style="color:red;text-align:center;"><?php echo $_COOKIE['FailedReason']; ?></p>
      <?php      
          }
      ?>
      <form action="verify.php" method="POST">
      <div class="parent">
        <div class="emailDiv">
           <p name="codeInp" style="width:300px;text-align:center;margin-bottom:10px">Enter Email To Subscribe</p>
           <input class="divEle" type="email" name="email" id="email" placeholder="Enter email here" style="border-radius:10px;width:300px;text-align:center" required>
           <input type="hidden" name="reqType" value="sub">
           <button class="divEle" style="width:50%;margin:20px auto" type="submit">Verify & Subscribe</button>
        </div>
      </div>
      </form>
      <form action="verify.php" method="POST">
      <div class="parent">
        <div class="emailDiv">
           <p name="codeInp" style="width:300px;text-align:center;margin-bottom:10px">Enter Email To Unsubscribe</p>
           <input class="divEle" type="email" name="email" id="email" placeholder="Enter email here" style="border-radius:10px;width:300px;text-align:center" required>
           <input type="hidden" name="reqType" value="unsub">
           <button class="divEle" style="width:50%;margin:20px auto" type="submit">Verify & Unsubscribe</button>
        </div>
      </div>
      </form>
      </section>
    </main>
</body>
</html>
