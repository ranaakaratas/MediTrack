
    <h2>Log Your Mood</h2>
    <form action="addMood.php" method="POST">
    <div class="mb-3">
        <label for="moodId">Select Your Mood:</label>
        <select class="form-select" id="moodId" name="moodId" required>
            <?php foreach ($moods as $mood): ?>
                <option value="<?= $mood->id ?>"><?= $mood->description ?></option>
            <?php endforeach; ?>
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
        <label for="mood_level">Mood Level:</label>
        <select class="form-select" id="mood_level" name="mood_level" required>
            <option value="1"> A little</option>
            <option value="2"> Mild</option>
            <option value="3"> Neutral</option>
            <option value="4"> Strong</option>
            <option value="5"> Very Strong</option>
        </select>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" type="submit">Log Mood</button>
    </div>
    </form>
    <div class="mb-3">
        <a href="home.php">🔙 Back to Home</a>
    </div>