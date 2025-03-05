<div class="container">
    
    <h2 class="text-center my-4">Welcome, <?= htmlspecialchars($patient->name) ?></h2>
    <h4 class="text-center my-4">Today, <?= date('d F Y') ?></h4>

    
    <!-- Date Selector -->
     <!-- Date Selection Buttons -->
    <div class="d-flex justify-content-center my-3">
        <?php for ($i = -2; $i <= 2; $i++): 
            $date = date('Y-m-d', strtotime("$i days")); 
            $label = date('D, d M', strtotime($date));
        ?>
            <button class="btn mx-2 <?= ($date == $selected_date) ? 'btn-primary' : 'btn-outline-primary' ?> date-button" 
                    data-date="<?= $date ?>">
                <?= $label ?>
            </button>
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
                            <strong>Mood:</strong> <?= isset($row['mood']) ? "N/A" : htmlspecialchars($moodLog->mood->description); ?> |
                            <strong>Energy Level:</strong> <?= isset($row['energy_level']) ? "N/A" : htmlspecialchars($moodLog->energyLevel); ?> |
                            <strong>Timestamp:</strong> <?= isset($row['timestamp']) ? $row['timestamp'] : "N/A"; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No mood logs for this date.</p>
                <?php endif; ?>

                <div class="d-flex justify-content-end">
                    <a href="addMood.php">
                        <button class="btn btn-primary">Log Mood</button>
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
                            <strong>Activity:</strong> <?= isset($row['activity']) ? "N/A" : htmlspecialchars($activityLog->activity->description) ; ?> |
                            <strong>Timestamp:</strong> <?= isset($row['timestamp']) ? $row['timestamp'] : "N/A"; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No activities logged for this date.</p>
                <?php endif; ?>

                <div class="d-flex justify-content-end">
                    <a href="addActivity.php">
                        <button class="btn btn-primary">Log Activity</button>
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
                            <strong>Medication:</strong> <?= isset($row['medication']) ? htmlspecialchars($row['medication']) : "N/A"; ?> |
                            <strong>Dosage:</strong> <?= isset($row['dosage']) ? $row['dosage'] : "N/A"; ?> |
                            <strong>Timestamp:</strong> <?= isset($row['timestamp']) ? $row['timestamp'] : "N/A"; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No medications recorded for this date.</p>
                <?php endif; ?>

                <div class="d-flex justify-content-end">
                    <a href="addMedication.php">
                        <button class="btn btn-primary">Log Medication</button>
                    </a>
                </div>

            </div>
    </div>


    </div>
</div>

<!-- AJAX Script for Dynamic Updates -->
<script>
$(document).ready(function() {
    $(".date-button").click(function() {
        var selectedDate = $(this).data("date");

        $.ajax({
            url: "home.php",
            type: "GET",
            data: { date: selectedDate },
            success: function(response) {
                $("#log-container").html($(response).find("#log-container").html());
                $(".date-button").removeClass("btn-primary").addClass("btn-outline-primary");
                $(this).removeClass("btn-outline-primary").addClass("btn-primary");
            }
        });
    });
});
</script>
    <!-- Logout Button -->
    <div class="text-center">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>
