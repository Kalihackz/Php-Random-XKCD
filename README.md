<h1 align="center"><img src="https://via.placeholder.com/1270x120/0d1117/fffff?text=RANDOM+XKCD+CHALLENEGE" /></h1>

<p align="center"><strong>A small PHP web application for sending random XKCD comics every 5 mins to subscribed emails.</strong></p>

<p align="center">
  <img  alt="user" src="https://img.shields.io/badge/Developed by-brightgreen" />
  <img  alt="user" src="https://img.shields.io/badge/Abir Ghosh-(Kalihackz)-brightgreen" />
</p>

<p align="center">
    <img src="https://img.shields.io/badge/php version-v7.0.33-blueviolet" alt="Current php version" />
    <img src="https://img.shields.io/badge/uptime-95%25-brightgreen" alt="Follow @reactnative" />
</p>

 <br>
 
<img src="https://via.placeholder.com/1270x120/0d1117/ffb300?text=Live+URL" />

<p align="center"><strong>https://bolder-exclusive-stargazer.glitch.me/ </strong></p>

<br />

<img src="https://via.placeholder.com/1270x120/0d1117/77ff00?text=Problem+Statement" />
<h3>➤ Email a random XKCD challenge</h3>
  <ul>
    <li>Create a simple PHP application that accepts a visitor’s email address</li>
    <li>Emails them random XKCD comics every five minutes.</li>
  </ul>
  <h4>➤ [Important Points]</h4>
  <ul>
    <li>App should include email verification to avoid people using others’ email addresses</li>
    <li>XKCD image should go as an email attachment as well as inline image content</li>
    <li>Emails should contain an unsubscribe link so a user can stop getting emails</li>
  </ul>

<img src="https://via.placeholder.com/1270x120/0d1117/ff00c8?text=Working" />
  
In this PHP Assignment , a user will get an email containing a random image from XKCD Comics every 5 minutes until the user unsubscribes it.
The random image is taken from the XKCD Comics Website.For getting the email , the user first has to register his email id.First he has to verify his email by a verification code and then only he will be registered.
The 5 mins gap email will have an inline-content image and also an attachment inside with a link to unsubscribe so that they won't receive any further emails. When a email is received there will be a random image every 5 mins.
Similarly for unsubscribing he has to verify his email id , then only he will be unsubscribed.
 

<img src="https://via.placeholder.com/1270x120/0d1117/ff00c8?text=Assumptions+Made" />

<ul>
    <li>Used https://c.xkcd.com/random/comic/ programmatically to return a random comic URL</li>
    <li>Used JSON API for details https://xkcd.com/json.html to fetch comic image</li>
    <li>Used <strong>Mailjet</strong> REST API for <strong>Email</strong> purposes</li>
    <li>Used <strong>Glitch</strong> Platform for <strong>Hosting</strong> purposes</li>
    <li>Used <strong>RemoteMySQL</strong> Platform for <strong>Online SQL Database</strong> purposes</li>
    <li>Used <strong>Cron-job.org</strong> Platform for <strong>Keeping Backend Servers Online and pinging website</strong> every 5 mins</li>
    <li><strong>All Verification Emails</strong> will be Available in <strong>ALL MAILS SECTION</strong> of your mail box</li>
</ul>

<img src="https://via.placeholder.com/1270x120/0d1117/ff00c8?text=Technology+And+Platforms+Used" />

<h3 align="center">Languages Used</h3>

<p align="center">
  <img src="https://user-images.githubusercontent.com/64020453/122255420-b7ba2c00-ceeb-11eb-95f6-0f0b97ecaf36.png" width="120px" alt="Html5" />
  ㅤㅤ
  <img src="https://user-images.githubusercontent.com/64020453/122253146-893b5180-cee9-11eb-9a79-7850748f0737.png" width="120px" alt="Php" />
</p>

<h3 align="center">Platform Used</h3>

<p align="center">
  <img src="https://user-images.githubusercontent.com/64020453/122251160-e46c4480-cee7-11eb-87e0-ec80a7171ce8.png" alt="Glitch" />
</p>

<h3 align="center">Database Used</h3>

<p align="center">
  <img src="https://user-images.githubusercontent.com/64020453/122251851-82600f00-cee8-11eb-8239-9f333704b4f9.png" width="120px" alt="Mysql" />
</p>

<h3 align="center">External Services Used</h3>

<p align="center">
  <img src="https://user-images.githubusercontent.com/64020453/122249783-c225f700-cee6-11eb-9f2e-71282dc31d63.png" alt="Mailjet API" />
  ㅤㅤ
  <img src="https://user-images.githubusercontent.com/64020453/122256243-7d9d5a00-ceec-11eb-9782-d3fbccab67f4.png" alt="cron-job" />
</p>

