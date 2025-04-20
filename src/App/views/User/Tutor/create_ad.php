<?php include $this->resolve("partials/_header.php"); ?>
<?php include $this->resolve("partials/_alert.php"); ?>

<head>
    <link rel="stylesheet" href="/assets/styles/Tutor/create_ad.css">
</head>

<div class="ad-container">
    <div class="ad-header">
        <h1>Create Course Advertisement</h1>
        <p>Fill in the details below to create your course advertisement</p>
    </div>

    <div class="ad-form-container">
        <form id="ad-form">
            <div class="ad-form-group">
                <label for="courseTitle">Course Title</label>
                <input type="text" id="courseTitle" name="courseTitle" required>
            </div>

            <div class="ad-form-group">
                <label for="courseCategory">Subject</label>
                <select id="courseCategory" name="courseCategory" required>
                    <option value="">Select a category</option>
                    <option value="programming">Programming</option>
                    <option value="design">Design</option>
                    <option value="business">Business</option>
                    <option value="marketing">Marketing</option>
                    <option value="languages">Languages</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="ad-form-group">
                <label for="courseDescription">Description</label>
                <textarea id="courseDescription" name="courseDescription" required></textarea>
            </div>

            <div class="ad-form-group">
                <label for="course-url">URL to Course</label>
                <input type="text" id="course-url" name="course-url" placeholder="https://learnhub.com/courses/123456" required>
            </div>

            <div class="price-duration-container">
                <div class="ad-form-group">
                    <label for="duration">Advertisement Duration (Days)</label>
                    <select id="duration" name="duration" required onchange="updatePrice()">
                        <option value="">Select duration</option>
                        <option value="7">7 days (Rs. 1000)</option>
                        <option value="15">15 days (Rs. 1800)</option>
                        <option value="30">30 days (Rs. 3000)</option>
                        <option value="60">60 days (Rs. 5500)</option>
                    </select>
                </div>
                <div class="ad-form-group total-price">
                    <label>Total Price</label>
                    <div class="price-display">Rs. 0.00</div>
                </div>
            </div>

            <div class="ad-form-group">
                <label for="courseImage">Thumbnail</label>
                <div class="upload-area" onclick="document.getElementById('courseImage').click()">
                    <p>Click to upload image</p>
                    <p>or drag and drop</p>
                    <input type="file" id="courseImage" name="courseImage" accept="image/*" style="display: none">
                </div>
            </div>

            <div class="button-group">
                <!-- <button type="submit" class="btn">Create Advertisement</button> -->
                <button type="button" class="btn btn-payment" onclick="processPayment()">Proceed to Payment</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updatePrice() {
        const duration = document.getElementById('duration').value;
        const priceMap = {
            '7': 1000,
            '15': 1800,
            '30': 3000,
            '60': 5500
        };
        const price = priceMap[duration] || 0;
        document.querySelector('.price-display').textContent = `Rs. ${price.toFixed(2)}`;
    }

    function processPayment() {
        const duration = document.getElementById('duration').value;
        if (!duration) {
            alert('Please select advertisement duration before proceeding to payment');
            return;
        }
    }
</script>

<?php include $this->resolve('partials/_footer.php') ?>