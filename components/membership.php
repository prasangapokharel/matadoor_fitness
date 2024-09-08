<?php
require 'event/db_connect.php';


// Fetch membership plans from the database
$sql = "SELECT plan_name, price, description, yearly_equivalent FROM membership_plans";
$result = $conn->query($sql);
?>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

<div class="membership-section">
    <h2>Memberships</h2>
    <p>We offer the PF Black Card® Membership and Classic Membership. Both get you access to The Judgement Free Zone®, and tons of cardio and strength equipment.</p>
    <div class="membership-cards">
        
        <?php
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="card <?= $row['plan_name'] === '6 Months' ? 'highlight' : '' ?>">
                    <?php if ($row['plan_name'] === '6 Months') { ?>
                        <div class="best-value"><i class="fa-solid fa-star" style="color: #FFD43B;"></i> Best Value</div>
                    <?php } ?>
                    <h3><?php echo $row['plan_name']; ?></h3>
                    <p><?php echo $row['plan_name'] === '6 Months' ? 'Most Popular' : ''; ?></p>
                    <div class="price">Rs <?php echo $row['price']; ?></div>
                    <p>plus taxes & fees</p>
                    <p><?php echo $row['description']; ?></p>
                    <p class="yearly-comparison">Yearly equivalent: <strong>Rs <?php echo $row['yearly_equivalent']; ?></strong></p>
                    <a href="registration">
                        <button>Join Now</button>
                    </a>
                </div>
                <?php
            }
        } else {
            echo "No membership plans found.";
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
</div>
<style>
    
/* Membership Section */
.membership-section {
    margin: 20px auto;
    border: 2px;
    border-radius: 20px;
    padding: 50px 0;
    background-color: #f7f8fa;
    text-align: center;
}

.membership-section h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #333;
    text-transform: uppercase;
}

.membership-section p {
    font-size: 1.1rem;
    margin-bottom: 40px;
    color: #666;
}

.membership-cards {
    display: flex;
    border: 5px;
    border-radius: 1rem;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.card {
    background-color: #fff;
    padding: 20px;
    text-align: left;
    border: 5px;
    border-radius: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    width: 280px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
}

.card.highlight {
    background: rgb(255, 255, 255);
    color: rgb(0, 0, 0);
}

.card.highlight .price {
    color: #000000;
}

.card .best-value {
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: #ffffff;
    color: rgb(9, 0, 0);
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.9rem;
    font-weight: bold;
}

.card h3 {
    font-size: 1.6rem;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.card p {
    color: #666;
    font-size: 1rem;
    margin-bottom: 15px;
}

.card .price {
    font-size: 2rem;
    margin-bottom: 10px;
}

.card button {
    padding: 10px 20px;
    font-size: 1rem;
    color: rgb(255, 255, 255);
    background-color: #fc9003;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.card.highlight button {
    background-color: #fc9003;
    color: #ffffff;
}

.card button:hover {
    background-color: #4e1485;
}

.card.highlight button:hover {
    background-color: #ffcc00;
    color: #6a1b9a;
}
</style>
<!-- Add your existing styling -->
