<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">

        <title>SafisAudio</title>

        @vite([
            'resources/css/app.css',
            'resources/css/safisaudio.css',
            'resources/js/app.js',
        ])

    </head>

    <body>

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">

            <div class="container">

                <a class="navbar-brand fw-bold" href="/">
                    SafisAudio
                </a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div
                    class="collapse navbar-collapse justify-content-end"
                    id="navbarNav">

                    <ul class="navbar-nav align-items-lg-center">

                        <li class="nav-item">
                            <a href="#home" class="nav-link">
                                Home
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#services" class="nav-link">
                                Our Services
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#why" class="nav-link">
                                Why Choose Us
                            </a>
                        </li>

                        <li class="nav-item ms-lg-3">
                            <a href="/login"
                            class="btn btn-outline-custom">
                                Login
                            </a>
                        </li>

                        <li class="nav-item ms-lg-2">
                            <a href="/register"
                            class="btn btn-primary-custom">
                                Get Started
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </nav>

        <!-- HERO SECTION -->
        <section id="home" class="hero-section">

            <div class="hero-overlay"></div>

            <div class="container position-relative">

                <div class="row justify-content-center">

                    <div class="col-lg-11 text-center hero-content">

                        <h1 class="hero-title">
                            Elevate Your Sound to

                            <span class="gradient-text">
                                Better Quality
                            </span>
                        </h1>

                        <p class="hero-description">
                            Transform your audio into something better, with the latest
                            AI technology. High-quality audio enhancement in seconds.
                        </p>

                        <div class="hero-buttons">
                            <a href="/register" class="btn btn-primary-custom">
                                Get Started
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </a>

                            <a href="#services" class="btn btn-outline-custom">
                                Watch Demo
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- OUR SERVICES -->
        <section id="services" class="section-padding bg-light">

            <div class="container">

                <div class="text-center mb-5">

                    <h2 class="services-title">
                        Our Services
                    </h2>

                    <p class="services-subtitle">
                        Professional AI-powered audio enhancement solutions.
                    </p>

                </div>

                <div class="row g-4">

                    <!-- CARD 1 -->
                    <div class="col-lg-4 col-md-6">

                        <div class="service-card">

                            <div class="service-icon">
                                <i class="bi bi-mic"></i>
                            </div>

                            <h4>Noise Reduction</h4>

                            <p>
                                Remove unwanted background noise automatically
                                and make audio cleaner.
                            </p>

                            <img
                                src="/img/service-1.jpg"
                                alt="Noise Reduction"
                                class="service-image">

                        </div>

                    </div>

                    <!-- CARD 2 -->
                    <div class="col-lg-4 col-md-6">

                        <div class="service-card">

                            <div class="service-icon">
                                <i class="bi bi-soundwave"></i>
                            </div>

                            <h4>Audio Enhancement</h4>

                            <p>
                                Improve voice clarity and overall sound quality
                                using AI technology.
                            </p>

                            <img
                                src="/img/service-2.jpg"
                                alt="Audio Enhancement"
                                class="service-image">

                        </div>

                    </div>

                    <!-- CARD 3 -->
                    <div class="col-lg-4 col-md-6">

                        <div class="service-card">

                            <div class="service-icon">
                                <i class="bi bi-camera-video"></i>
                            </div>

                            <h4>Before & After Comparison</h4>

                            <p>
                                Compare original and enhanced audio results
                                instantly.
                            </p>

                            <img
                                src="/img/service-3.jpg"
                                alt="Comparison"
                                class="service-image">

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- WHY CHOOSE US -->
        <section id="why" class="section-padding">

            <div class="container">

                <div class="text-center mb-5">

                    <h2 class="fw-bold why-title">
                        Why Choose Us
                    </h2>

                    <p class="text-secondary mt-3">
                        Built for students, creators, and professionals.
                    </p>

                </div>

                <div class="row justify-content-center g-5">

                    <div class="col-lg-3 col-md-6">

                        <div class="why-card">

                            <div class="why-icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <h4>AI Powered Enhancement</h4>

                            <p>
                                State-of-the-art machine learning algorithms for
                                superior audio quality.
                            </p>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="why-card">

                            <div class="why-icon">
                                <i class="bi bi-lightning"></i>
                            </div>

                            <h4>Fast Processing</h4>

                            <p>
                                Process hours of audio in minutes with our optimized
                                infrastructure.
                            </p>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="why-card">

                            <div class="why-icon">
                                <i class="bi bi-star"></i>
                            </div>

                            <h4>Better Quality</h4>

                            <p>
                                Studio-grade results that rival expensive hardware
                                solutions.
                            </p>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="why-card">

                            <div class="why-icon">
                                <i class="bi bi-patch-check"></i>
                            </div>

                            <h4>Easy to Use</h4>

                            <p>
                                Intuitive interface designed for both beginners and
                                professionals.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- FREE TRIAL CTA -->
        <section class="section-padding">

            <div class="container">

                <div class="cta-section text-center">

                    <div class="cta-overlay"></div>

                    <div class="cta-content">

                        <h2 class="fw-bold">
                            Ready To Transform Your Audio?
                        </h2>

                        <p>
                            Join thousands of creators who trust SafisAudio for
                            professional audio enhancement. Start your journey today.
                        </p>

                        <a href="/register"
                        class="btn btn-primary-custom">

                            Get Started
                            <i class="bi bi-arrow-right-circle-fill"></i>

                        </a>

                    </div>

                </div>

            </div>

        </section>

        <!-- FOOTER -->
        <footer class="footer-section">

            <div class="container">

                <div class="row gy-5">

                    <!-- Brand -->
                    <div class="col-lg-4">

                        <h3 class="footer-logo">
                            SafisAudio
                        </h3>

                        <p class="footer-description">
                            AI-powered audio enhancement platform designed to help
                            students, creators, and professionals achieve clearer,
                            cleaner, and more professional sound quality.
                        </p>

                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-2 col-md-4">

                        <h5 class="footer-title">
                            Navigation
                        </h5>

                        <ul class="footer-links">

                            <li>
                                <a href="#home">Home</a>
                            </li>

                            <li>
                                <a href="#services">Services</a>
                            </li>

                            <li>
                                <a href="#why">Why Us</a>
                            </li>

                        </ul>

                    </div>

                    <!-- Contact -->
                    <div class="col-lg-3 col-md-4">

                        <h5 class="footer-title">
                            Contact
                        </h5>

                        <ul class="footer-links">

                            <li>
                                <a href="mailto:hello@safisaudio.com">
                                    hello@safisaudio.com
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    Instagram
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    LinkedIn
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>

                <div class="footer-divider"></div>

                <div class="footer-bottom">

                    <p>
                        © 2026 SafisAudio. All rights reserved.
                    </p>

                </div>

            </div>

        </footer>

    </body>
</html>