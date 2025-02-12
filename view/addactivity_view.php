
<h2>Log Your Activity</h2>
    <form action="addactivity.php" method="POST">
    <div class="mb-3">
        <label for="activityId">Select Your Activity:</label>
        <select class="form-select" id="activityId" name="activityId" required>
            <?php foreach ($activities as $activity): ?>
                <option value="<?= $activity->id ?>"><?= $activity->description ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <button class="btn btn-primary" type="submit">Log Activity</button>
    </div>
    </form>
    <div class="mb-3">
        <a href="home.php">🔙 Back to Home</a>
    </div>