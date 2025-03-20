<div class="container">

    <h2 class="text-center my-4">Welcome, <?= htmlspecialchars($patient->name) ?></h2>
    <h4 class="text-center my-4">Today, <?= date('d F Y') ?></h4>

    <?php 
        $today = date('Y-m-d'); // Get today's date
        $is_today = ($selected_date == $today); // Boolean check if selected date is today
    ?>

    <!-- Date Selection Buttons -->
    <div class="d-flex justify-content-center my-3">
        <?php for ($i = -2; $i <= 2; $i++): 
            $date = date('Y-m-d', strtotime("$i days")); 
            $label = date('D, d M', strtotime($date));
        ?>
            <a href="?date=<?= $date ?>" class="btn mx-2 <?= ($date == $selected_date) ? 'btn-primary' : 'btn-outline-primary' ?>">
                <?= $label ?>
            </a>
        <?php endfor; ?>
    </div>

    <!-- Mood Log Container -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Your Moods</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($mood_result)): ?>
                <?php foreach ($mood_result as $row): ?>
                    <div class="alert alert-info">
                        <strong>Mood:</strong> <?= htmlspecialchars($row['mood_description'] ?? 'N/A') ?> |
                        <strong>Energy Level:</strong> <?= htmlspecialchars($row['energy_level'] ?? 'N/A') ?> |
                        <strong>Timestamp:</strong> <?= htmlspecialchars($row['timestamp'] ?? 'N/A') ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">No mood logs for this date.</p>
            <?php endif; ?>

            <div class="d-flex justify-content-end">
                <a href="addmood.php?date=<?= $selected_date ?>">
                    <button class="btn btn-primary" <?= $is_today ? '' : 'disabled' ?>>Log Mood</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Activity Log Container -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Your Activities</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($activity_result)): ?>
                <?php foreach ($activity_result as $row): ?>
                    <div class="alert alert-secondary">
                        <strong>Activity:</strong> <?= htmlspecialchars($row['activity_description'] ?? 'N/A') ?> |
                        <strong>Timestamp:</strong> <?= htmlspecialchars($row['timestamp'] ?? 'N/A') ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">No activities logged for this date.</p>
            <?php endif; ?>

            <div class="d-flex justify-content-end">
                <a href="addactivity.php?date=<?= $selected_date ?>">
                    <button class="btn btn-primary" <?= $is_today ? '' : 'disabled' ?>>Log Activity</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Medication Log Container -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Your Medications</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($medication_result)): ?>
                <?php foreach ($medication_result as $row): ?>
                    <div class="alert alert-light border">
                        <strong>Medication:</strong> <?= htmlspecialchars($row['medication_name'] ?? 'N/A') ?> |
                        <strong>Dosage:</strong> <?= htmlspecialchars($row['dosage'] ?? 'N/A') ?> |
                        <strong>Timestamp:</strong> <?= htmlspecialchars($row['timestamp'] ?? 'N/A') ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">No medications recorded for this date.</p>
            <?php endif; ?>

            <div class="d-flex justify-content-end">
                <a href="addmedication.php?date=<?= $selected_date ?>">
                    <button class="btn btn-primary" <?= $is_today ? '' : 'disabled' ?>>Log Medication</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Logout Button -->
    <div class="text-center my-4">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

</div>

