<div class="container">
    
    <h2 class="text-center my-4">Welcome, <?= htmlspecialchars($patient->name) ?></h2>
    <h4 class="text-center my-4">Today, <?= date('d F Y') ?></h4>

    
    <!-- Date Selector -->
    <div class="d-flex justify-content-center my-3">
        <div class="btn-group" role="group" aria-label="Date Selector">
            <button type="button" class="btn btn-outline-secondary"> <?= date('l', strtotime('-2 days')) ?>  <br>  <?= date('d F', strtotime('-2 days')) ?></button>
            <button type="button" class="btn btn-outline-secondary"> <?= date('l', strtotime('-1 days')) ?>  <br>  <?= date('d F', strtotime('-1 days')) ?></button>
            <button type="button" class="btn btn-primary">  <?= date('l', strtotime('0 days')) ?>  <br>  <?= date('d F', strtotime('0 days')) ?></button>
            <button type="button" class="btn btn-outline-secondary"> <?= date('l', strtotime('+1 days')) ?>  <br>  <?= date('d F', strtotime('+1 days')) ?></button>
            <button type="button" class="btn btn-outline-secondary"> <?= date('l', strtotime('+2 days')) ?>  <br>  <?= date('d F', strtotime('+2 days')) ?></button>

        </div>
    </div>
    
    
    <!-- Doctor Details Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Your Doctor</h4>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> <?= htmlspecialchars($doctor->name) ?></p>
            <p><strong>Specialty:</strong> <?= htmlspecialchars($doctor->specialty) ?></p>
            <p><strong>Contact Info:</strong> <?= htmlspecialchars($doctor->contactInfo) ?></p>
            <p><strong>Hospital:</strong> <?= htmlspecialchars($doctor->hospital) ?></p>
        </div>
    </div>

    <!-- Moods Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Your Moods</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($moods)): ?>
                <ul class="list-group">
                    <?php foreach ($moods as $mood): ?>
                        <li class="list-group-item">
                            <strong>Mood:</strong> <?= htmlspecialchars($moodLog->mood->description) ?> 
                            <strong>Energy Level:</strong> <?= htmlspecialchars($moodLog->energyLevel) ?>
                            <strong>Timestamp:</strong> <?= htmlspecialchars($moodLog->timestamp) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No moods logged for this date.</p>
            <?php endif; ?>
            <div class="d-flex justify-content-end">
                 <a href="addmood.php">
                    <button class="btn btn-primary">Log mood</button>
                </a>
            </div>
        </div>
    </div>



    <!-- Activities Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Your Activities</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($activityLogs)): ?>
                <ul class="list-group">
                    <?php foreach ($activityLogs as $activityLog): ?>
                        <li class="list-group-item">
                            <strong>Activity:</strong> <?= htmlspecialchars($activityLog->activity->description) ?> |
                            <strong>Timestamp:</strong> <?= htmlspecialchars($activityLog->timestamp) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">No activity data available.</p>
            <?php endif; ?>
            <div class="d-flex justify-content-end">
                 <a href="addactivity.php">
                    <button class="btn btn-primary">Log Activity</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Medications Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Your Medications</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($medications)): ?>
                <ul class="list-group">
                    <?php foreach ($medications as $medication): ?>
                        <li class="list-group-item">
                            <strong>Medication:</strong> <?= htmlspecialchars($medication['name']) ?> |
                            <strong>Dosage:</strong> <?= htmlspecialchars($medication['dosage']) ?> |
                            <strong>Timestamp:</strong> <?= htmlspecialchars($medication['timestamp']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">No medication data available.</p>
            <?php endif; ?>
            <div class="d-flex justify-content-end">
                <a href="addmedication.php">
                    <button class="btn btn-primary">Log Medication</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Logout Button -->
    <div class="text-center">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>
