<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<style type="text/css">
.hero {
  background: url('hero-bg.jpg') center/cover no-repeat;
  color: #fff;
  text-align: center;
  padding: 100px 20px;
}
.hero h1 {
  font-size: 2.5rem;
  margin-bottom: 10px;
}
.hero p {
  font-size: 1.2rem;
  margin-bottom: 20px;
}
.hero .btn-primary, .hero .btn-secondary {
  text-decoration: none;
  padding: 10px 20px;
  margin: 5px;
  border-radius: 5px;
  font-size: 1rem;
}
.hero .btn-primary {
  background: #ff6347;
  color: #fff;
}
.hero .btn-secondary {
  background: #555;
  color: #fff;
}

/* Room Categories */
.categories {
  padding: 50px 20px;
  background: #f9f9f9;
}
.categories h2 {
  text-align: center;
  margin-bottom: 30px;
}
.category-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}
.category-card {
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  overflow: hidden;
  text-align: center;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.category-card img {
  width: 100%;
  height: 150px;
  object-fit: cover;
}
.category-card h3 {
  margin: 10px 0;
}
.category-card p {
  padding: 0 10px 20px;
  font-size: 0.9rem;
  color: #666;
}

/* Promotions Section */
.promotions {
  padding: 50px 20px;
  background: #fff;
}
.promotions h2 {
  text-align: center;
  margin-bottom: 30px;
}
.promotion-card {
  background: #ff6347;
  color: #fff;
  padding: 20px;
  margin: 10px auto;
  max-width: 600px;
  border-radius: 10px;
  text-align: center;
}
.promotion-card h3 {
  margin-bottom: 10px;
}

	</style>


<section id="categories" class="categories">
    <h2>Choose Your Experience</h2>
    <div class="category-grid">
      <div class="category-card">
        <img src="karaoke.jpg" alt="Karaoke Room">
        <h3>Karaoke Rooms</h3>
        <p>Sing your heart out with top-notch sound systems.</p>
      </div>
      <div class="category-card">
        <img src="gaming.jpg" alt="Gaming Room">
        <h3>Gaming Lounges</h3>
        <p>Enjoy the ultimate gaming experience with friends.</p>
      </div>
      <div class="category-card">
        <img src="theater.jpg" alt="Private Theater">
        <h3>Private Theaters</h3>
        <p>Watch your favorite movies in style.</p>
      </div>
      <div class="category-card">
        <img src="party.jpg" alt="Party Room">
        <h3>Party Rooms</h3>
        <p>Perfect for birthdays, celebrations, and more.</p>
      </div>
    </div>
  </section>

  <!-- Featured Promotions -->
  <section id="promotions" class="promotions">
    <h2>Special Offers</h2>
    <div class="promotion-card">
      <h3>20% Off Karaoke Rooms</h3>
      <p>Book now and save big on Friday nights!</p>
    </div>
    <div class="promotion-card">
      <h3>Free Drinks for Groups</h3>
      <p>Get complimentary drinks for groups of 10 or more.</p>
    </div>
  </section>


