<?php

namespace App\views\components;

class Alert
{
    public static function show_alert(string $message, string $type = 'info'): string
    {
        $alertTypes = ['success', 'danger', 'warning', 'info'];
        $type = in_array($type, $alertTypes) ? $type : 'info';
        $escapedMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        return (
            "
            <style>
                .alert {
                    display: flex;
                    align-items: center;
                    padding: 10px;
                    border-radius: 5px;
                    margin: 10px;
                    font-size: 16px;
                    opacity: 0;
                    transform: translateY(-20px);
                    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
                    position: fixed;
                    bottom: 10px;
                    right: 10px;
                    background-color: #f8f9fa;
                    color: #333;
                    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                    z-index: 1000;
                }
                
                .alert.show {
                    opacity: 1;
                    transform: translateY(0);
                }
                
                .alert.success { border-left: 6px solid #28a745; }
                .alert.danger { border-left: 6px solid #dc3545; }
                .alert.warning { border-left: 6px solid #ffc107; }
                .alert.info { border-left: 6px solid #17a2b8; }
                
                .alert .icon {
                    margin-right: 12px;
                    font-size: 18px;
                }
                
                .alert .close-btn {
                    margin-left: auto;
                    cursor: pointer;
                    font-size: 20px;
                    font-weight: bold;
                }
            </style>
            <script>
                function showAlert(message,type) {
                        const alert = document.createElement('div');
                        alert.classList.add('alert', 'show', '$type');
                        alert.innerHTML = `
                            <span class='icon'>✔️</span>
                            <span class='message'>$escapedMessage</span>
                            <span class='close-btn' onclick='this.parentElement.remove()'>×</span>
                        `;
                        document.body.appendChild(alert);
                        setTimeout(() => alert.remove(), 5000);
                });
            </script>"
        );
    }
}
