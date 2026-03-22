<?php require 'config.php'; ?>

<?php
// Fetch about data
$stmt = $pdo->query("SELECT profile_image, cv_link FROM about LIMIT 1");
$about = $stmt->fetch(PDO::FETCH_ASSOC);
$profileImage = $about['profile_image'] ?? 'Profile_pic.jpg';
$cvLink = $about['cv_link'] ?? '#';

// Fetch all blogs
$blogs = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC")->fetchAll();

// Fetch all projects
$projects = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aminour Islam - Student and web developer">
    <title>Aminour Islam | Student & Web Developer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header & Navigation (unchanged) -->
    <header>
        <div class="container nav-container">
            <a href="#" class="logo">Md<span>Aminour</span></a>
            <nav>
                <ul class="nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#blogs">Blogs</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <!-- Hero Section (unchanged) -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content fade-in">
                <h1>Aminour Islam</h1>
                <p>Student | Developer | Programming Learner</p>
                <div class="hero-btns">
                    <a href="#projects" class="btn">View My Work</a>
                    <a href="#contact" class="btn btn-secondary">Contact Me</a>
                </div>
            </div>
        </div>
        <div class="hero-bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <!-- About Section (dynamic) -->
    <section class="section about" id="about">
        <div class="container">
            <h2 class="section-title fade-in">About Me</h2>
            <div class="about-content">
                <div class="about-img fade-in">
                    <img src="<?= htmlspecialchars($profileImage) ?>" alt="Aminour Islam photograph" loading="lazy">
                </div>
                <div class="about-text fade-in">
                    <h3>Hi, I'm Aminour</h3>
                    <p>I'm a student and passionate to be a developer based in Chattogram, Bangladesh, driven by a deep love for technology and innovation. My interests lie at the intersection of programming and engineering, where I enjoy building solutions through Python and web development.</p>
                    <p>Beyond technical skills, I have cultivated leadership abilities and a strong sense of social responsibility through volunteer work and community engagement.</p>
                    <p>I'm constantly inspired by the intersection of creativity and technology, and I'm always looking for new challenges that allow me to grow.</p>
                    <a href="<?= htmlspecialchars($cvLink) ?>" class="btn" download>Download CV</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section (dynamic) -->
    <section class="section blogs" id="blogs">
        <div class="container">
            <h2 class="section-title fade-in">Blogs</h2>
            <div class="blog-grid">
                <?php foreach ($blogs as $index => $blog): ?>
                <?php $altClass = ($index % 2 !== 0) ? 'blog-post-alt' : ''; ?>
                <div class="blog-post <?= $altClass ?> fade-in">
                    <div class="blog-img">
                        <img src="<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" loading="lazy">
                    </div>
                    <div class="blog-text">
                        <h3><?= htmlspecialchars($blog['title']) ?></h3>
                        <p><?= nl2br(htmlspecialchars(substr($blog['content'], 0, 200))) ?>...</p>
                        <a href="post.php?id=<?= $blog['id'] ?>" class="btn">Read More →</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Projects Section (dynamic) -->
    <section class="section projects" id="projects">
        <div class="container">
            <h2 class="section-title fade-in">Projects</h2>
            <div class="projects-grid">
                <?php foreach ($projects as $project): ?>
                <?php $techArray = explode(',', $project['technologies']); ?>
                <div class="project-card fade-in">
                    <div class="project-img">
                        <img src="<?= htmlspecialchars($project['image']) ?>" alt="<?= htmlspecialchars($project['title']) ?>" loading="lazy">
                    </div>
                    <div class="project-content">
                        <h3><?= htmlspecialchars($project['title']) ?></h3>
                        <p><?= nl2br(htmlspecialchars($project['description'])) ?></p>
                        <?php if (!empty($techArray)): ?>
                        <div class="tech-stack">
                            <?php foreach ($techArray as $tech): ?>
                                <span><?= htmlspecialchars(trim($tech)) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <div class="project-links">
                            <?php if (!empty($project['github_link'])): ?>
                                <a href="<?= htmlspecialchars($project['github_link']) ?>"><i class="fab fa-github"></i> GitHub</a>
                            <?php endif; ?>
                            <?php if (!empty($project['live_link'])): ?>
                                <a href="<?= htmlspecialchars($project['live_link']) ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Live Demo</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Skills Section (unchanged) -->
    <section class="section skills" id="skills">
        <div class="container">
            <h2 class="section-title fade-in">Skills</h2>
            <div class="skills-container">
                <div class="skill-category fade-in">
                    <h3><i class="fas fa-code"></i> Development</h3>
                    <div class="skill-list">
                        <span class="skill-item">HTML</span>
                        <span class="skill-item">CSS</span>
                        <span class="skill-item">JavaScript(Basic)</span>
                        <span class="skill-item">Responsive Design</span>
                        <span class="skill-item">Python(Basic)</span>
                    </div>
                </div>
                <div class="skill-category fade-in">
                    <h3><i class="fa-solid fa-head-side-gear"></i> Soft Skills</h3>
                    <div class="skill-list">
                        <span class="skill-item">Leadership</span>
                        <span class="skill-item">Adaptability</span>
                        <span class="skill-item">Teamwork</span>
                        <span class="skill-item">Problem solving</span>
                        <span class="skill-item">Responsibility</span>
                    </div>
                </div>
                <div class="skill-category fade-in">
                    <h3><i class="fas fa-edit"></i> Tools & Apps</h3>
                    <div class="skill-list">
                        <span class="skill-item">Microsoft Office</span>
                        <span class="skill-item">VS Code</span>
                        <span class="skill-item">Google Suite</span>
                        <span class="skill-item">Canva</span>
                        <span class="skill-item">InShot</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section (unchanged) -->
    <section class="section contact" id="contact">
        <div class="container">
            <h2 class="section-title fade-in">Contact Me</h2>
            <div class="contact-container">
                <div class="contact-info fade-in">
                    <h3>Let's Work Together</h3>
                    <p>I'm always interested in new opportunities, whether it's social work, web development, or creative collaboration.</p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span><a href="mailto:mdamenourislam@gmail.com">mdamenourislam@gmail.com</a></span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span><a href="tel:+8801790025801">+880 1790025801</a></span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Chattogram, Bangladesh</span>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="https://wa.me/+8801790025801?text=Hello," target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://m.me/md.aminour.islam.sayad" target="_blank" aria-label="Messenger"><i class="fab fa-facebook-messenger"></i></a>
                        <a href="https://github.com/Aminourislam" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
                        <a href="" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="contact-form fade-in">
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" class="form-control" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn">Send Message</button>
                        <div id="form-status" style="margin-top: 15px; text-align: center;"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (unchanged) -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <a href="#" class="footer-logo">Md<span>Aminour</span></a>
                <div class="footer-links">
                    <a href="#home">Home</a>
                    <a href="#about">About</a>
                    <a href="#blogs">Blogs</a>
                    <a href="#projects">Projects</a>
                    <a href="#skills">Skills</a>
                    <a href="#contact">Contact</a>
                </div>
                <p class="copyright">Copyright &copy; <span id="current-year"></span> MdAminour. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Lightbox (unchanged) -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-content">
            <img src="" alt="Lightbox Image">
            <div class="lightbox-close"><i class="fas fa-times"></i></div>
            <div class="lightbox-nav">
                <button class="lightbox-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="lightbox-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>