<?php
if (!isset($event) || !$event) {
    echo "<p>Event not found.</p>";
    return;
}

$eventId = $event['id'];
$stmt = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE event_id = ?");
$stmt->execute([$eventId]);
$attendeesCount = $stmt->fetchColumn();
$available = $event['seats'] - $attendeesCount;
$percentage = $event['seats'] > 0 ? round(($attendeesCount / $event['seats']) * 100) : 0;
$backUrl = $routes['list'];
?>

<div class="back-link-container">
    <a href="<?= $backUrl ?>" class="back-link">&larr; Back to Events</a>
</div>
<div class="event-details">
    <div class="event-main">
        <div class="event-image">
            <img src="<?= !empty($event['image']) ? $event['image'] : 'images/default-event.jpg' ?>" 
                 alt="<?= $event['title'] ?>" loading="lazy">
        </div>

        <h1 class="event-title"><?= $event['title'] ?></h1>
        
        <div class="event-status">
            <span class="status-badge status-<?= strtolower($event['status']) ?>">
                <?= strtoupper($event['status']) ?>
            </span>
        </div>

        <div class="event-description">
            <h3>About This Event</h3>
            <p><?= $event['description'] ?></p>
        </div>

        <div class="event-info-grid">
            <div class="info-box">
                <h4>Date & Time</h4>
                <p><?= date('M d, Y', strtotime($event['event_date'])) ?></p>
            </div>

            <div class="info-box">
                <h4>Location</h4>
                <p><?= $event['location'] ?></p>
            </div>

            <div class="info-box">
                <h4>Capacity</h4>
                <p><?= $attendeesCount ?> / <?= $event['seats'] ?> Reserved</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?= $percentage ?>%"></div>
                </div>
            </div>

            <div class="info-box">
                <h4>Available Spots</h4>
                <p><?= $available ?> spots remaining</p>
            </div>
        </div>
    </div>

    <aside class="event-sidebar">
        <div class="sidebar-card">
            <h3>Quick Stats</h3>
            <div class="stat-item">
                <span class="stat-label">Total Capacity</span>
                <span class="stat-value"><?= $event['seats'] ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Reservations</span>
                <span class="stat-value"><?= $attendeesCount ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Available</span>
                <span class="stat-value"><?= $available ?></span>
            </div>
            <button class="reserve-btn">Reserve Spot</button>
        </div>
    </aside>
</div>
