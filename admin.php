<?php include "db.php"; ?>

<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $logo_url = $_POST['logo_url'];
    $category = $_POST['category'];

    $sqlProduct = "INSERT INTO products (name, description, logo_url, category)
                   VALUES ('$name', '$description', '$logo_url', '$category')";

    if($conn->query($sqlProduct)){
        $product_id = $conn->insert_id;

        // Product Features
        foreach($_POST['feature_text'] as $index => $text){
            $icon = $_POST['icon'][$index];
            $conn->query("INSERT INTO product_features (product_id, icon, feature_text)
                          VALUES ($product_id, '$icon', '$text')");
        }

        // Pricing Plans
        foreach($_POST['plan_name'] as $i => $plan_name){
            $monthly = $_POST['monthly_price'][$i];
            $yearly = $_POST['yearly_price'][$i];
            $btn = $_POST['button_text'][$i];

            $sqlPlan = "INSERT INTO pricing_plans (product_id, plan_name, button_text)
                        VALUES ($product_id, '$plan_name', '$btn')";

            if($conn->query($sqlPlan)){
                $plan_id = $conn->insert_id;
                $conn->query("INSERT INTO plan_prices (plan_id, monthly_price, yearly_price, price_unit)
                              VALUES ($plan_id, '$monthly', '$yearly', '/user/month')");

                foreach($_POST['plan_features'][$i] as $pf){
                    $conn->query("INSERT INTO plan_features (plan_id, feature_text)
                                  VALUES ($plan_id, '$pf')");
                }
            }
        }

        echo "<div class='success'>Product created successfully!</div>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
body { font-family: Arial; background:#f7f7f7; padding:30px; }
.container { max-width:850px; margin:auto; background:#fff; padding:30px; border-radius:12px; box-shadow:0 0 20px rgba(0,0,0,0.1); }
h2, h3 { color:#333; }
input, textarea { width:100%; padding:12px; margin-top:8px; border-radius:8px; border:1px solid #ccc; font-size:16px; }
button { padding:12px 20px; border:none; background:#007bff; color:#fff; border-radius:8px; cursor:pointer; }
button:hover { opacity:0.85; }
.add-btn { background:#28a745; font-size:14px; padding:5px 12px; margin:10px 0; }
.step { display:none; }
.step.active { display:block; }
.nav-btn { margin-top:20px; }
.success { padding:12px; background:#d4edda; color:#155724; border-radius:8px; margin-bottom:10px; }

</style>
<script>
function nextStep(id){ document.querySelectorAll(".step").forEach(s => s.classList.remove("active")); document.getElementById(id).classList.add("active"); }
function addFeature(){
    let box = document.getElementById("features");
    box.insertAdjacentHTML("beforeend", `<div>
        <input type="text" name="icon[]" placeholder="Emoji">
        <input type="text" name="feature_text[]" placeholder="Feature Text"><br><br>
    </div>`);
}
function addPlanFeature(planId){
    let box = document.getElementById("plan_features_"+planId);
    box.insertAdjacentHTML("beforeend", `<input type="text" name="plan_features[`+planId+`][]" placeholder="Feature"><br>`);
}
</script>
</head>
<body>

<div class="container">

<h2>✨ Create New Product</h2>

<form method="POST">

<!-- STEP 1 -->
<div class="step active" id="step1">
<h3>Product Details</h3>
<input type="text" name="name" placeholder="Product Name" required>
<textarea name="description" placeholder="Description" required></textarea>
<input type="text" name="logo_url" placeholder="Logo URL" required>
<input type="text" name="category" placeholder="Category" required>
<div class="nav-btn"><button type="button" onclick="nextStep('step2')">Next ➜</button></div>
</div>

<!-- STEP 2 -->
<div class="step" id="step2">
<h3>Product Features</h3>
<div id="features">
<input type="text" name="icon[]" placeholder="Emoji">
<input type="text" name="feature_text[]" placeholder="Feature Text"><br><br>
</div>
<button type="button" class="add-btn" onclick="addFeature()">+ Add More Feature</button>
<div class="nav-btn">
<button type="button" onclick="nextStep('step1')">⬅ Back</button>
<button type="button" onclick="nextStep('step3')">Next ➜</button>
</div>
</div>

<!-- STEP 3 -->
<div class="step" id="step3">
<h3>Pricing Plans</h3>

<?php for($p=0;$p<4;$p++): ?>
<h4>Plan <?php echo $p+1; ?></h4>
<input type="text" name="plan_name[]" placeholder="Plan Name">
<input type="text" name="monthly_price[]" placeholder="Monthly Price">
<input type="text" name="yearly_price[]" placeholder="Yearly Price">
<input type="text" name="button_text[]" placeholder="Button Text">

<div id="plan_features_<?php echo $p; ?>">
<input type="text" name="plan_features[<?php echo $p; ?>][]" placeholder="Feature"><br>
</div>
<button type="button" class="add-btn" onclick="addPlanFeature(<?php echo $p; ?>)">+ Add Plan Feature</button>
<hr>
<?php endfor; ?>

<div class="nav-btn">
<button type="button" onclick="nextStep('step2')">⬅ Back</button>
<button type="submit" name="submit">Create Product ✓</button>
</div>
</div>
</form>
</div>
</body>
</html>
