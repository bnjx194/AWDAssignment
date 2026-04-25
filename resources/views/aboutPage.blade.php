<x-header/>

<main class="about-page">
    <section class="hero">
        <p class="kicker">About REM</p>
        <h1>Real Estate Made Simple</h1>
        <p>We're revolutionizing the real estate industry by making property buying, selling, and browsing accessible to everyone.</p>
    </section>

    <section class="section">
        <h2>Our Story</h2>
        <p>Founded in 2011, REM started with a simple vision: to transform the real estate market into a transparent, user-friendly platform.</p>
        <p>We believed buying or selling property shouldn't be complicated. We've focused on eliminating barriers and empowering our users.</p>
    </section>

    <section class="section">
        <h2>Our Values</h2>
        <div class="grid">
            <div class="card"><div class="icon">🎯</div><h3>Mission</h3><p>Empower people to find and list properties with confidence.</p></div>
            <div class="card"><div class="icon">⭐</div><h3>Transparency</h3><p>No hidden fees. No surprises. What you see is what you get.</p></div>
            <div class="card"><div class="icon">👥</div><h3>Community</h3><p>Buyers, sellers, and agents connecting with confidence.</p></div>
            <div class="card"><div class="icon">🚀</div><h3>Innovation</h3><p>Continuously improving our platform to serve you better.</p></div>
        </div>
    </section>

    <section class="stats">
        <div class="stats-grid">
            <div><h3>10,000+</h3><p>Properties Listed</p></div>
            <div><h3>50,000+</h3><p>Happy Customers</p></div>
            <div><h3>$2.5B+</h3><p>Transactions</p></div>
            <div><h3>15+</h3><p>Years of Excellence</p></div>
        </div>
    </section>

    <section class="section">
        <h2>Meet Our Team</h2>
        <div class="grid">
            <div class="card text-center"><div class="icon">👨‍💼</div><h3>John Anderson</h3><p class="role">Founder & CEO</p><p>20+ years in real estate.</p></div>
            <div class="card text-center"><div class="icon">👩‍💼</div><h3>Sarah Mitchell</h3><p class="role">COO</p><p>Focused on customer satisfaction.</p></div>
            <div class="card text-center"><div class="icon">👨‍💻</div><h3>Michael Chen</h3><p class="role">CTO</p><p>Drives our technological innovation.</p></div>
            <div class="card text-center"><div class="icon">👩‍💻</div><h3>Emily Rodriguez</h3><p class="role">Head of Customer Success</p><p>Ensures exceptional experience.</p></div>
        </div>
    </section>

    <section class="cta">
        <h2>Ready to Get Started?</h2>
        <p>Join thousands of satisfied customers today.</p>
        <div class="cta-btns">
            <a href="/buy" class="btn-primary">Browse Properties</a>
            <a href="/sell" class="btn-secondary">List Your Property</a> 
        </div>
    </section>
</main>
<x-footer/>





<style>
    

.about-page {
     font-family: sans-serif; color: #1b2a3a; max-width: 1100px; margin: 0 auto; padding: 2rem;
     }

.hero { 
    background: linear-gradient(120deg, #09203f 0%, #537895 100%); border: 1px solid #0f2d4d; border-radius: 12px; padding: 3rem 2rem; text-align: center; margin-bottom: 2rem; 
}
.hero h1 { 
    color: #ffffff; font-size: 2rem; margin: 0.5rem 0; 
}
.hero p { 
    color: rgba(255, 255, 255, 0.92); line-height: 1.7; max-width: 600px; margin: 0 auto; 
}
.kicker { 
    color: rgba(255, 255, 255, 0.9); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 0.5rem; 
}

.section { 
    margin-bottom: 2rem; 
}
.section h2 { 
    color: #122c46; font-size: 1.5rem; margin-bottom: 1rem;
 }
.section p { 
    color: #556676; line-height: 1.8; margin-bottom: 0.75rem;
 }

.grid { 
    display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-top: 1rem; 
}

.card { 
    background: #fbfdff; border: 1px solid #dce7f4; border-radius: 10px; padding: 1.25rem; 
}
.card h3 { 
    color: #1b344e; font-size: 14px; margin-bottom: 6px; 
}
.card p { 
    color: #556676; font-size: 13px; line-height: 1.6; margin: 0; 
}
.icon { 
    font-size: 1.5rem; margin-bottom: 0.5rem; 
}
.text-center { 
    text-align: center; 
}
.role { 
    color: #35516d; font-size: 12px; font-weight: 600; margin-bottom: 6px; 
}

.stats { 
    background: linear-gradient(120deg, #0e223a 0%, #2a4c6f 100%); border-radius: 12px; padding: 2rem; margin-bottom: 2rem; 
}
.stats-grid { 
    display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 16px; text-align: center; 
}
.stats-grid h3 { 
    font-size: 1.8rem; font-weight: 700; color: #fff; 
}
.stats-grid p { 
    font-size: 12px; color: rgba(255, 255, 255, 0.86); 
}

.cta { 
    background: #ffffff; border: 1px solid #dce7f4; border-radius: 12px; padding: 2.5rem; text-align: center; margin-bottom: 2rem; 
}
.cta h2 { 
    color: #122c46; margin-bottom: 0.5rem; 
}
.cta p { 
    color: #556676; margin-bottom: 1.25rem; 
}
.cta-btns { 
    display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; 
}

.btn-primary { 
    background: #0b2240; color: #fff; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; 
}
.btn-secondary { 
    border: 2px solid #c7d6e6; color: #0b2240; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; 
}
.btn-primary:hover, .btn-secondary:hover { 
    opacity: 0.85; 
    }
</style>