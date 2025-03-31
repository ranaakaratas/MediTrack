<h2>Welcome</h2>  


<form method="GET" action="admin.php">
    <div class="mb-3">
        <label for="patient" class="form-label">Select a patient:</label>
        <select class="form-select" id="patient" name="patient_id" onchange="this.form.submit()">
            <option disabled selected>Select a patient</option>
            <?php foreach ($patients as $patient): ?>
                <option value="<?= htmlspecialchars($patient->id) ?>"
                    <?= isset($_GET['patient_id']) && $_GET['patient_id'] == $patient->id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($patient->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</form>

<?php if (!empty($logs)): ?>
    <h4 class="mt-4">Patient Logs</h4>
    <ul class="list-group">
        <?php foreach ($logs as $log): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($log->timestamp) ?> - <?= htmlspecialchars($log->moodLevel) ?> mood
            </li>
        <?php endforeach; ?>
    </ul>
<?php elseif (isset($_GET['patient_id'])): ?>
    <p class="mt-4">No logs found for this patient.</p>
<?php endif; ?>

