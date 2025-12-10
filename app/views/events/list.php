<?php
$page_title = 'Events';

?>

<div class="page-header">
    <h1>Upcoming Events</h1>
    <p class="subtitle">Discover and join amazing events near you</p>
</div>

<div class="search-filters-container">
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search events by name or location...">
        <span class="search-icon">🔍</span>
    </div>
    <div class="filters-container"></div>
</div>


    <div class="events-grid">
    <?php foreach ($events as $event): 
        
        // Récupérer l'ID de l'événement
        $eventId = $event['id'];

        // Compter les réservations
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservations WHERE event_id = ?");
        $stmt->execute([$eventId]);
        $attendees = $stmt->fetchColumn();
        $seats = $event['seats'] ?? 0;
        $fillPercentage = $seats > 0 ? round(($attendees / $seats) * 100) : 0;
    ?>
        <div class="event-card">

            <div class="event-card-image">
                <img src="<?= $event['image'] ?>" alt="<?= $event['title'] ?>" loading="lazy">
                <span class="event-status-badge status-<?= strtolower($event['status']) ?>">
                    <?= strtoupper($event['status']) ?>
                </span>
            </div>

            <div class="event-card-content">
                <h3><?= $event['title'] ?></h3>

                <div class="event-meta">
                    <div class="meta-item">
                        <!-- Icône calendrier -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span><?= date('M d, Y', strtotime($event['event_date'])) ?></span>
                    </div>
                    <div class="meta-item">
                        <!-- Icône localisation -->
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span><?= $event['location'] ?></span>
                    </div>
                </div>

                <!-- Barre de remplissage des seats -->
                <div class="event-capacity">
                    <div class="capacity-info">
                        <span class="capacity-label">Seats</span>
                    </div>
                    <div class="capacity-bar" style="background: #eee; border-radius: 4px; overflow: hidden; height: 10px; margin-top: 5px;">
                        <div class="capacity-fill" style="width: <?= $fillPercentage ?>%; background: #4caf50; height: 100%;"></div>
                    </div>
                </div>

<a href="<?= $routes['details'] . $event['id'] ?>" class="view-details-btn">
    View Details
</a>

            </div>
        </div>
    <?php endforeach; ?>
</div>
