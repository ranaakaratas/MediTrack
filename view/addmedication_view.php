<h2>Log Your Medication</h2>
<form action="addmedication.php" method="POST">
    <div class="mb-3">
        <label for="medicationId">Select Your Medication:</label>
        <select class="form-select" id="medicationId" name="medicationId" required>
            <?php foreach ($medications as $medication): ?>
                <option value="<?= $medication->id ?>"><?= $medication->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="dosage">Dosage (mg):</label>
        <input type="number" class="form-control" id="dosage" name="dosage" required>
    </div>


    <input type="hidden" name="patientId" value="<?= $patient->id ?>">
    <input type="hidden" name="date" value="<?= date('Y-m-d', strtotime($_GET['date'])) ?? date('Y-m-d H:i:s'); ?>">

    <div class="mb-3">
        <button class="btn btn-primary" type="submit">Log Medication</button>
    </div>
</form>
<div class="mb-3">
    <a href="index.php">🔙 Back to Home</a>
</div>
