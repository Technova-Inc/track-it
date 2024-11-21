<div class="col-auto mb-4">
    <div class="card shadow-lg percentage-card">
        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
            <h5 class="card-title">ID Disque <?= $disk_id ?></h5>
            <div class="arc-container">
                <svg width="200" height="100" viewBox="0 0 200 100">
                    <circle cx="100" cy="100" r="80" fill="none" stroke="#4caf50" stroke-width="20"/>
                    <circle cx="100" cy="100" r="80" fill="none" stroke="#ddd" stroke-width="20" stroke-dasharray="251" stroke-dashoffset="0" id="storage-arc<?= $disk_id ?>"/>
                </svg>
                <div class="percentage" id="percentage-text<?= $disk_id ?>">100%</div>
            </div>
        </div>
    </div>
</div>