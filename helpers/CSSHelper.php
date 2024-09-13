<?php

class CSSHelper
{
    public static function getCardStatusCSS()
    {
        return "
            /* Default Card Styles */
            .card-status {
                background-color: white;
                border-radius: 0.5rem;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
                padding: 1rem;
                margin-bottom: 1rem;
            }

            /* Hover Effects for Different Statuses */
            .hover-bg-secondary:hover {
                background-color: #6c757d;
                color: white;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                transform: translateY(-3px);
            }

            .hover-bg-info:hover {
                background-color: #17a2b8;
                color: white;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                transform: translateY(-3px);
            }

            .hover-bg-warning:hover {
                background-color: #ffc107;
                color: black;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                transform: translateY(-3px);
            }

            .hover-bg-success:hover {
                background-color: #28a745;
                color: white;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                transform: translateY(-3px);
            }

            .hover-bg-danger:hover {
                background-color: #dc3545;
                color: white;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                transform: translateY(-3px);
            }

            /* Specific Card Styles for Different Statuses */
            .card-status.secondary {
                border-left: 5px solid #6c757d;
            }

            .card-status.info {
                border-left: 5px solid #17a2b8;
            }

            .card-status.warning {
                border-left: 5px solid #ffc107;
            }

            .card-status.success {
                border-left: 5px solid #28a745;
            }

            .card-status.danger {
                border-left: 5px solid #dc3545;
            }
        ";
    }
}

