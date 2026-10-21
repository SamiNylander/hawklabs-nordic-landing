<?php
/* Template Name: HawkLabs Nordic Template */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HawkLabs / Nordic</title>
    <link href="https://googleapis.com" rel="stylesheet">
    <style>
        :root {
            --bg-color: #050811;
            --card-bg: #0b1120;
            --accent-yellow: #ffe600;
            --accent-green: #10b981;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --border-color: #1e293b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            padding: 0 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .logo {
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        nav a {
            color: var(--text-muted);
            text-decoration: none;
            margin-left: 20px;
            font-size: 14px;
        }

        /* Hero Section */
        .hero {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 60px;
            padding: 100px 0;
            align-items: center;
        }

        .hero-tag {
            color: var(--accent-yellow);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 54px;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 24px;
        }

        .hero p {
            color: var(--text-muted);
            font-size: 16px;
            margin-bottom: 40px;
            max-width: 480px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--accent-yellow);
            color: #000;
        }

        .btn-secondary {
            border: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .hero-badge-card {
            background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 60px;
            text-align: center;
        }

        /* Section Layouts */
        .lab-section {
            padding: 80px 0;
            border-top: 1px solid var(--border-color);
        }

        .section-title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 40px;
            letter-spacing: -1px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .lab-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 30px;
        }

        .card-num {
            color: var(--accent-yellow);
            font-size: 12px;
            margin-bottom: 15px;
        }

        .lab-card h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .lab-card p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 20px;
        }

        .features-list {
            list-style: none;
            font-size: 13px;
        }

        .features-list li {
            margin-bottom: 10px;
            color: var(--text-muted);
        }

        .features-list li::before {
            content: "+ ";
            color: var(--accent-yellow);
        }

        /* JobHawk Deep Dive Split */
        .split-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            padding: 80px 0;
            border-top: 1px solid var(--border-color);
        }

        .steps-list {
            margin-top: 30px;
        }

        .step-item {
            display: flex;
            gap: 20px;
            margin-bottom: 24px;
        }

        .step-num {
            color: var(--accent-yellow);
            font-weight: 800;
            font-size: 18px;
        }

        .step-text h4 {
            font-size: 16px;
            margin-bottom: 4px;
        }

        .step-text p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .video-placeholder {
            background-color: #020617;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            aspect-ratio: 16/9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            cursor: pointer;
        }

        .play-btn {
            width: 60px;
            height: 60px;
            background-color: var(--accent-yellow);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #000;
            font-size: 20px;
            margin-bottom: 15px;
        }

        /* Feature Table Style */
        .table-section {
            display: grid;
            grid-template-columns: 0.8fr 1.2fr;
            gap: 60px;
            padding: 80px 0;
            border-top: 1px solid var(--border-color);
        }

        .status-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .status-table td {
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .status-badge {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--accent-green);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            float: right;
        }

        footer {
            padding: 60px 0;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            color: var(--text-muted);
            font-size: 13px;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">HAWKLABS / NORDIC</div>
        <nav>
            <a href="#">JobHawk</a>
            <a href="#">Roadmap</a>
            <a href="#">Contact</a>
        </nav>
    </header>

    <main>
        <!-- HERO SECTION -->
        <section class="hero">
            <div>
                <div class="hero-tag">Independent Technology Studio - Norrköping</div>
                <h1>Intelligent digital ecosystems, engineered in the Nordics.</h1>
                <p>HawkLabs Nordic turns complex friction into calm, connected software—built to scale from first release to global markets.</p>
                <div class="btn-group">
                    <a href="#" class="btn btn-primary">Explore JobHawk &rarr;</a>
                    <a href="#" class="btn btn-secondary">View roadmap</a>
                </div>
            </div>
            <div class="hero-badge-card">
                <div style="font-size: 40px; margin-bottom: 15px;">🦅</div>
                <h2>HAWKLABS NORDIC</h2>
                <div style="font-size: 11px; color: var(--accent-yellow); letter-spacing: 3px; margin-top: 10px;">INTELLIGENCE · DESIGN · SCALE</div>
            </div>
        </section>

        <!-- JOBLAWK DEEP DIVE -->
        <section class="split-section">
            <div>
                <div class="hero-tag">Core Architecture</div>
                <h2 class="section-title">JobHawk: hiring intelligence, ready now.</h2>
                <div class="steps-list">
                    <div class="step-item">
                        <div class="step-num">01</div>
                        <div class="step-text">
                            <h4>Autonomous Sourcing Pipeline</h4>
                            <p>Scrapes, filters and maps candidates across multiple vectors without manual interaction.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">02</div>
                        <div class="step-text">
                            <h4>Semantic Matching Core</h4>
                            <p>Goes beyond keywords to understand actual project capability and technical compatibility.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-num">03</div>
                        <div class="step-text">
                            <h4>Zero Friction Deployment</h4>
                            <p>Integrates natively with your current internal software ecosystem via isolated APIs.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-placeholder">
                <div class="play-btn">▶</div>
                <span style="font-size: 14px; font-weight: 500;">JobHawk Onboarding & Product Walkthrough</span>
