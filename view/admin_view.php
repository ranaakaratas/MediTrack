<h2>Welcome</h2>  
<h4 class="text-center my-4">Today, <?= date('d F Y') ?></h4>

<div class="container">

    <!-- Patient Selector -->
    <form method="GET" action="admin.php">
        <div class="mb-3">
            <label for="patient" class="form-label">Select a patient:</label>
            <select class="form-select" id="patient" name="patient_id" onchange="this.form.submit()">
                <option disabled selected>Select a patient</option>
                <?php foreach ($patients as $patient): ?>
                    <option value="<?= $patient->id ?>"
                        <?= isset($_GET['patient_id']) && $_GET['patient_id'] == $patient->id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($patient->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <?php if (isset($selectedPatient)): ?>
        <div class="alert alert-info my-3">
            <strong>Medical Notes:</strong> <?= htmlspecialchars($selectedPatient->medicalNotes) ?>
        </div>
    <?php endif; ?>


    <?php if (isset($selectedPatient)): ?>
        <form method="POST" action="download_logs.php" target="_blank">
            <input type="hidden" name="patient_id" value="<?= htmlspecialchars($selectedPatient->id) ?>">
            <button type="submit" class="btn btn-outline-dark my-3">
                📄 Download Last 30 Days of Logs
            </button>
        </form>
    <?php endif; ?>


    <?php if (isset($selectedPatient)): ?>

        <!-- Date Picker -->
        <div class="d-flex justify-content-center my-3">
            <?php
            for ($i = -2; $i <= 2; $i++) {
                $date = date('Y-m-d', strtotime("$i days"));
                $label = date('D, d M', strtotime($date));
                $selected = ($_GET['date'] ?? date('Y-m-d')) === $date;
            ?>
                <a href="?patient_id=<?= $_GET['patient_id'] ?>&date=<?= $date ?>"
                   class="btn mx-2 <?= $selected ? 'btn-primary' : 'btn-outline-primary' ?>">
                    <?= $label ?>
                </a>
            <?php } ?>
        </div>

        <!-- Mood Log Container -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Patient's Mood Logs</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($logs)): ?>
                    <?php foreach ($logs as $log): ?>
                        <div class="alert alert-info">
                            <strong>Mood:</strong> <?= htmlspecialchars($log->mood->description ?? 'N/A') ?> |
                            <strong>Energy Level:</strong> <?= htmlspecialchars($log->energyLevel ?? 'N/A') ?> |
                            <strong>Timestamp:</strong> <?= htmlspecialchars($log->timestamp ?? 'N/A') ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No mood logs for this date.</p>
                <?php endif; ?>
            </div>
        </div>


        <!-- Activity Log Container -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">Patient's Activity Logs</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($activityLogs)): ?>
                    <?php foreach ($activityLogs as $log): ?>
                        <div class="alert alert-warning">
                            <strong>Activity:</strong> <?= htmlspecialchars($log->activity->description ?? 'N/A') ?> |
                            <strong>Timestamp:</strong> <?= htmlspecialchars($log->timestamp ?? 'N/A') ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No activity logs for this date.</p>
                <?php endif; ?>
            </div>
        </div>


        <!-- Medication Log Container -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Patient's Medication Logs</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($medicationLogs)): ?>
                    <?php foreach ($medicationLogs as $log): ?>
                        <div class="alert alert-success">
                            <strong>Medication:</strong> <?= htmlspecialchars($log->medication->name ?? 'N/A') ?> |
                            <strong>Dosage:</strong> <?= htmlspecialchars($log->dosage ?? 'N/A') ?> |
                            <strong>Timestamp:</strong> <?= htmlspecialchars($log->timestamp ?? 'N/A') ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">No medication logs for this date.</p>
                <?php endif; ?>
            </div>
        </div>




    <?php elseif (isset($_GET['patient_id'])): ?>
        <p class="mt-4 text-muted">No logs found for this patient.</p>
    <?php endif; ?>
    
    <!-- Logout Button -->
    <div class="text-center my-4">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

