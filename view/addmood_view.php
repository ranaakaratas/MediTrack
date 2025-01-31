
<head>
    <title>Log Your Mood</title>
</head>
<body>
    <h2>Log Your Mood</h2>
    <form action="addMood.php" method="POST">
    <div class="mb-3">
        <label for="mood_level">Select Your Mood:</label>
        <select class="form-select" id="mood_level" name="mood_level" required>
            
        </select>
    </div>
    <div class="mb-3">
        <label for="energy_level">Energy Level:</label>
        <select class="form-select" id="energy_level" name="energy_level" required>
            <option value="1">⚡ Very Energetic</option>
            <option value="2">😊 Energetic</option>
            <option value="3">😐 Neutral</option>
            <option value="4">😴 Tired</option>
            <option value="5">🥱 Exhausted</option>
        </select>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" type="submit">Log Mood</button>
    </div>
    </form>
    <div class="mb-3">
        <a href="home.php">🔙 Back to Home</a>
    </div>
</body>
