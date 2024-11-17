<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /*footer*/
#footer {
    background-color: var(--main);
    color: #ffffff;
    padding: 40px 20px;
    font-family: 'Arial', sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    max-width: 1200px;
    gap: 30px;
}

#footer h3 {
    color: #ff4b4b;
    font-weight: 600;
    font-size: 1.8em;
    margin-bottom: 10px;
}

#footer h4 {
    color: #ff3b3b;
    margin-bottom: 15px;
    font-weight: 500;
    font-size: 1.2em;
    border-bottom: 2px solid #ff3b3b;
    display: inline-block;
    padding-bottom: 5px;
}

#footer p {
    font-size: 0.95em;
    line-height: 1.8;
    max-width: 320px;
    color: #cccccc;
}

.footer-content, .footer-links, .social-links {
    flex: 1;
}

.footer-links ul, .social-icons {
    list-style: none;
    padding: 0;
    display: flex;
    gap: 15px;
    align-items: center;
}

.footer-links ul li {
    margin-bottom: 8px;
    display: inline;
}

#footer a {
    color: white;
    text-decoration: none;
    font-size: 0.95em;
    transition: color 0.3s ease, transform 0.2s;
}

#footer a:hover {
    color: var(--red);
    transform: translateX(5px);
}

.social-links h4 {
    margin-bottom: 10px;
    text-align: center;
}

.social-icons a {
    font-size: 1.2em;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    justify-content: center;
    transition: color 0.3s ease, background-color 0.3s ease, transform 0.3s ease;
}

.social-icons a.facebook {
    color: #ffffff;
    background-color: #3b5998;
}

.social-icons a.facebook:hover {
    color: #3b5998;
    background-color: #ffffff;
}

.social-icons a.instagram {
    color: #ffffff;
    background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
}

.social-icons a.instagram:hover {
    color: #e6683c;
    background-color: #ffffff;
}

.social-icons a.twitter {
    color: #ffffff;
    background-color: #1da1f2;
}

.social-icons a.twitter:hover {
    color: #1da1f2;
    background-color: #ffffff;
}

.social-icons a.youtube {
    color: #ffffff;
    background-color: #ff0000;
}

.social-icons a.youtube:hover {
    color: #ff0000;
    background-color: #ffffff;
}


#footer hr {
    border: none;
    height: 1px;
    background-color: #444;
    width: 100%;
    max-width: 1200px;
    margin: 30px 0;
}


#footer .copyright {
    text-align: center;
    font-size: 0.85em;
    color: #aaaaaa;
    margin-top: 20px;
}


@media (max-width: 800px) {
    .footer-container {
        flex-direction: column;
        align-items: center;
    }

    .footer-content, .footer-links, .social-links {
        text-align: center;
    }

    .social-icons {
        justify-content: center;
    }
}
.form-date-duration{
    display: flex;
    
}


</style>    
</head>
<body>
    
</body>
<footer id="footer">
        <div class="footer-container">
            <div class="footer-content">
                <h3>Movie Insight</h3>
                <p>A website offering the latest, high-quality reviews of the hottest movies with fast updates.</p>
            </div>
    
 
            <div class="footer-links">
                <h4>Links</h4>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#movies">Movies</a></li>
                    <li><a href="#series">TV Shows</a></li>
                    <li><a href="#about">About us</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="social-links">
                <h4>Follow us</h4>
                <div class="social-icons">
                    <a href="https://facebook.com" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://youtube.com" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    
        <hr>
    
        <div class="copyright">© 2024 Movie Insight. All rights reserved.</p>
        </div>
    </footer>
</html>

