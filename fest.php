<?php
// Define all festivals
$festivals = [
    ['name' => 'Christmas', 'date' => '2025-12-05', 'banner' => 'banners/christmas.jpg', 'message' => 'Merry Christmas! Enjoy the holidays 🎄'],
    ['name' => 'New Year', 'date' => '2025-12-04', 'banner' => 'data:image/jpeg;base64,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', 'message' => 'Happy New Year! 🎉'],
    ['name' => 'Diwali', 'date' => '2025-10-20', 'banner' => 'banners/diwali.jpg', 'message' => 'Happy Diwali! 🪔'],
    ['name' => 'Holi', 'date' => '2025-03-17', 'banner' => 'banners/holi.jpg', 'message' => 'Celebrate Holi with colors! 🌈']
];

// Get today's date
$today = date('Y-m-d');

// Collect today's festivals
$todayFestivals = [];
foreach ($festivals as $festival) {
    if ($festival['date'] == $today) {
        $todayFestivals[] = $festival;
    }
}
?>

<?php if(!empty($todayFestivals)): ?>
<div class="festival-card-container">
    <?php foreach($todayFestivals as $festival): ?>
    <div class="festival-card">
        <button class="close-btn" aria-label="Close">&times;</button>
        <div class="image-wrapper">
            <img src="<?php echo $festival['banner']; ?>" alt="<?php echo $festival['name']; ?>">
            <div class="overlay-text">
                <h3><?php echo $festival['name']; ?></h3>
                <p><?php echo $festival['message']; ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<style>
.festival-card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center; /* centers horizontally */
    align-items: center;     /* centers vertically */
    margin: 0 auto;          /* center horizontally with auto margin */
    height: 100vh;           /* fill full viewport height */
    width: 100%;             /* full width */
    box-sizing: border-box;  /* include padding/border in size */
}


.festival-card {
    position: relative;
    width: 280px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    background: #fff;
    transition: transform 0.3s ease, opacity 0.5s ease;
}

.image-wrapper {
    position: relative;
    width: 100%;
    height: 180px;
    overflow: hidden;
}

.festival-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Text overlay on image */
.overlay-text {
    position: absolute;
    bottom: 10px;
    left: 10px;
    right: 10px;
    color: #fff;
    background: rgba(0, 0, 0, 0.5); /* translucent black background for readability */
    padding: 10px;
    border-radius: 10px;
    text-align: center;
}

.overlay-text h3 {
    margin: 0 0 5px 0;
    font-size: 20px;
    font-weight: 700;
    text-shadow: 0 0 5px rgba(0,0,0,0.7);
}

.overlay-text p {
    margin: 0;
    font-size: 14px;
    font-weight: 500;
    text-shadow: 0 0 5px rgba(0,0,0,0.7);
}

.close-btn {
    position: absolute;
    top: 8px;
    right: 12px;
    border: none;
    background: rgba(255, 0, 0, 0.7);
    font-size: 22px;
    color: #fff;
    cursor: pointer;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 22px;
    text-align: center;
    font-weight: bold;
    transition: background 0.3s ease;
    z-index: 10;
}

.close-btn:hover {
    background: rgba(255, 0, 0, 1);
}
</style>

<script>
const cards = document.querySelectorAll('.festival-card');

cards.forEach(card => {
    // Close button click
    const closeBtn = card.querySelector('.close-btn');
    closeBtn.addEventListener('click', () => {
        card.style.opacity = '0';
        setTimeout(() => card.style.display = 'none', 500);
    });

    // Auto-hide after 5 seconds
    setTimeout(() => {
        card.style.opacity = '0';
        setTimeout(() => card.style.display = 'none', 500);
    }, 5000);
});
</script>
