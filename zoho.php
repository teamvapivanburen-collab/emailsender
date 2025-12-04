<?php include "db.php"; ?>

<?php
// Get ID from URL
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);  // convert to integer safely
} else {
    die("No product selected!");
}

// Fetch Product
$product = $conn->query("SELECT * FROM products WHERE product_id = $id")->fetch_assoc();

// Fetch Features
$features = $conn->query("SELECT * FROM product_features WHERE product_id = $id");

// Fetch Pricing Plans
$plans = $conn->query("
    SELECT pricing_plans.*, plan_prices.monthly_price, plan_prices.yearly_price, plan_prices.price_unit
    FROM pricing_plans
    JOIN plan_prices ON pricing_plans.plan_id = plan_prices.plan_id
    WHERE pricing_plans.product_id = $id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f0f9f5;
    margin: 0;
    padding: 20px;
    color: #222;
  }
  .container {
    max-width: 1200px;
    margin: 0 auto;
  }
   .product-header {
    display: flex;
    align-items: center;
    gap: 30px;
    margin-bottom: 36px;
    flex-wrap: wrap;
  }
  
  /* Logo styling */
  .logo-wrapper {
    flex: 0 0 100px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .logo-wrapper img {
    max-width: 100px;
    height: auto;
    filter: drop-shadow(0 0 2px rgba(0,0,0,0.1));
  }
  
  /* Text info area */
  .info-wrapper {
    flex: 1;
    min-width: 250px;
  }
  .hero {
  /* width: 100%; */
  background: linear-gradient(135deg, #e9f7ef, #c8e6c9);
  padding: 60px 30px;
  border-radius: 20px;
  margin-bottom: 40px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

/* Light glowing circles */
.hero::before,
.hero::after {
  content: "";
  position: absolute;
  width: 260px;
  height: 260px;
  background: rgba(255, 255, 255, 0.35);
  border-radius: 50%;
  filter: blur(60px);
}
.hero::before {
  top: -60px;
  left: -60px;
}
.hero::after {
  bottom: -60px;
  right: -60px;
}

/* Hero Content */
.hero-content {
  position: relative;
  z-index: 2;
}

.hero-logo {
  height: 80px;
  margin-bottom: 18px;
  filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.1));
}

.hero-title {
  font-size: 2.8rem;
  margin: 0;
  color: #1b5e20;
  font-weight: 800;
}

.hero-desc {
  font-size: 1.2rem;
  max-width: 700px;
  margin: 16px auto 20px;
  color: #2e7d32;
  line-height: 1.6;
}

.hero-category {
  margin-top: 12px;
  font-size: 1.1rem;
  font-weight: 600;
  color: #1b5e20;
}
.hero-category span {
  color: #4caf50;
  font-weight: 700;
}

/* ---------------------------
   FEATURES SECTION
---------------------------- */
.features-section {
  margin: 40px 0;
  padding: 30px;
  background: #ffffffdd;
  border-radius: 16px;
  backdrop-filter: blur(10px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
}

.features-title {
  font-size: 2rem;
  color: #2e7d32;
  text-align: center;
  font-weight: 800;
  margin-bottom: 26px;
}

/* Features Grid */
.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 18px;
}

.feature-item {
  background: #e8f5e9;
  padding: 18px 20px;
  border-radius: 12px;
  font-size: 1.1rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 12px;
  border-left: 6px solid #4caf50;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  color: #2e7d32;
}

.feature-item:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 20px rgba(76, 175, 80, 0.25);
}

.feature-item .icon {
  font-size: 1.4rem;
}
  .info-wrapper h1 {
    font-size: 2.4rem;
    margin: 0 0 12px;
    color: #2e7d32;
    font-weight: 700;
  }
  
  .info-wrapper .description {
    font-size: 1.1rem;
    color: #555;
    margin: 0 0 10px;
  }
  
  .info-wrapper .category {
    font-size: 1rem;
    font-weight: 600;
    color: #388e3c;
  }
  
  .info-wrapper .category span {
    font-weight: 700;
  }
  
  /* Features box styling */
  .features {
    background: #e8f5e9;
    border-left: 6px solid #2e7d32;
    padding: 24px 28px;
    max-width: 650px;
    border-radius: 12px;
    margin-bottom: 40px;
  }
  
  .features h2 {
    margin-top: 0;
    font-weight: 700;
    color: #2e7d32;
    font-size: 1.6rem;
    margin-bottom: 16px;
  }
  
  .features ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
  }
  
  .features ul li {
    margin-bottom: 10px;
    font-size: 1.1rem;
    color: #333;
    position: relative;
    padding-left: 22px;
  }
  
  .features ul li::before {
    content: "✔";
    position: absolute;
    left: 0;
    color: #388e3c;
    font-weight: 700;
  }
  
  /* Responsive tweaks */
  @media (max-width: 720px) {
    .product-header {
      justify-content: center;
    }
    .info-wrapper {
      text-align: center;
      min-width: auto;
    }
    .features {
      max-width: 100%;
    }
  }
  header img {
    height: 60px;
    object-fit: contain;
  }
 

  /* Toggle Switch Container */
  .toggle-container {
    text-align: center;
    margin: 30px 0 40px;
  }

  .toggle-label {
    font-weight: 700;
    margin-right: 12px;
    font-size: 1rem;
    color: #555;
  }

  .toggle-switch {
    display: inline-flex;
    align-items: center;
    background: #e1f3e9;
    border-radius: 30px;
    padding: 5px 8px;
    cursor: pointer;
    user-select: none;
  }

  .toggle-switch input[type="radio"] {
    display: none;
  }

  .toggle-switch label {
    padding: 8px 22px;
    border-radius: 30px;
    font-weight: 600;
    color: #388e3c;
    transition: background-color 0.3s, color 0.3s;
  }

  .toggle-switch input[type="radio"]:checked + label {
    background-color: #388e3c;
    color: white;
  }

  .pricing-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-top: 20px;
  }

  @media (max-width: 1024px) {
    .pricing-cards {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 600px) {
    .pricing-cards {
      grid-template-columns: 1fr;
    }
  }

  /* Card Styles with different colors */
  .card {
    border-radius: 14px;
    box-shadow: 1px 8px 18px rgba(223, 20, 20, 0.12);
    padding: 28px 24px;
    text-align: center;
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
      border: 2px solid #90caf9;
  }
  .card:hover {
    transform: translateY(-8px);
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.18);
  }

  /* Card colors */
  .card.free {
    background: #e8f5e9;
    border: 2px solid #a5d6a7;
  }
  .card.express {
    background: #e3f2fd;
    border: 2px solid #90caf9;
  }
  .card.popular {
    background: #fff3e0;
    border: 2px solid #ffb74d;
    position: relative;
  }
  .card.popular::before {
    content: "★ MOST POPULAR";
    position: absolute;
    top: 14px;
    right: 14px;
    background: #fb8c00;
    color: white;
    font-weight: 700;
    font-size: 0.85rem;
    padding: 5px 10px;
    border-radius: 14px;
  }
  .card.bigin360 {
    background: #f3e5f5;
    border: 2px solid #ce93d8;
  }

  .card h3 {
    margin-top: 0;
    font-weight: 700;
    font-size: 1.7rem;
    color: #222;
  }
  .price {
    font-size: 2.8rem;
    font-weight: 900;
    margin: 16px 0 8px;
    color: #2e7d32;
  }
  .price small {
    display: block;
    font-weight: 600;
    color: #555;
    margin-top: -10px;
    font-size: 1rem;
  }
  .card button {
    background: #d32f2f;
    border: none;
    color: #fff;
    font-weight: 700;
    font-size: 1.1rem;
    padding: 14px 0;
    border-radius: 8px;
    margin-top: auto;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 0 4px 10px rgba(211, 47, 47, 0.6);
  }
  .card button:hover {
    background: #b71c1c;
    box-shadow: 0 6px 14px rgba(183, 28, 28, 0.8);
  }
  .card ul {
    list-style: none;
    padding-left: 0;
    margin: 24px 0 0;
    text-align: left;
    flex-grow: 1;
  }
  .card ul li {
    margin-bottom: 12px;
    padding-left: 22px;
    position: relative;
    font-size: 1.1rem;
    color: #444;
  }
  .card ul li::before {
    content: "✔";
    position: absolute;
    left: 0;
    color: #388e3c;
    font-weight: 700;
  }
</style>
<body>
  <div class="container">

  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-content">
      <img src="<?php echo $product['logo_url']; ?>" alt="Product Logo" class="hero-logo"/>

      <h1 class="hero-title"><?php echo $product['name']; ?></h1>
      <p class="hero-desc"><?php echo $product['description']; ?></p>

      <div class="hero-category">
        <span>Category:</span> <?php echo $product['category']; ?>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="features-section">
    <h2 class="features-title">Key Features</h2>
    <div class="features-grid">
      <?php while($f = $features->fetch_assoc()) : ?>
        <div class="feature-item">
          <span class="icon"><?php echo $f['icon']; ?></span>
          <?php echo $f['feature_text']; ?>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <!-- TOGGLE -->
  <div class="toggle-container" aria-label="Pricing toggle">
    <span class="toggle-label">Billing:</span>
    <div class="toggle-switch" role="radiogroup" aria-labelledby="billingToggleLabel">
      <input type="radio" id="monthly" name="billing" value="monthly" checked />
      <label for="monthly" tabindex="0">Monthly</label>
      <input type="radio" id="yearly" name="billing" value="yearly" />
      <label for="yearly" tabindex="0">Yearly</label>
    </div>
  </div>

  <!-- PRICING PLANS -->
  <section class="pricing-cards" aria-live="polite">
    <?php while($p = $plans->fetch_assoc()) : ?>
      <div class="card <?php echo $p['is_popular'] ? 'popular' : ''; ?>">
        <h3><?php echo $p['plan_name']; ?></h3>

        <div class="price"
            data-monthly="₹<?php echo $p['monthly_price']; ?>"
            data-yearly="₹<?php echo $p['yearly_price']; ?>">
            ₹<?php echo $p['monthly_price']; ?>
            <small><?php echo $p['price_unit']; ?></small>
        </div>

        <button><?php echo $p['button_text']; ?></button>

        <ul>
          <?php
            $plan_features = $conn->query("SELECT * FROM plan_features WHERE plan_id=".$p['plan_id']);
            while($pf = $plan_features->fetch_assoc()):
          ?>
            <li><?php echo $pf['feature_text']; ?></li>
          <?php endwhile; ?>
        </ul>
      </div>
    <?php endwhile; ?>
  </section>
</div>

<script>
const toggleRadios = document.querySelectorAll('input[name="billing"]');
const priceElements = document.querySelectorAll('.price');

function updatePrices(type) {
  priceElements.forEach(priceEl => {
    priceEl.innerHTML =
      (type === "yearly")
        ? `${priceEl.dataset.yearly} <small>/user/month billed yearly</small>`
        : `${priceEl.dataset.monthly} <small>/user/month</small>`;
  });
}

toggleRadios.forEach(radio => {
  radio.addEventListener("change", e => updatePrices(e.target.value));
});

updatePrices("monthly");
</script>
</body>
</html>
