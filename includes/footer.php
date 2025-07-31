<!-- No abras etiquetas PHP si no es necesario -->
<style>
/* Estilos personalizados para footer de estación de combustible */
.fuel-footer {
    background: linear-gradient(135deg, #1a0f0b 0%, #2c1810 25%, #3d2317 50%, #2c1810 75%, #1a0f0b 100%);
    position: relative;
    overflow: hidden;
    border-top: 4px solid transparent;
    border-image: linear-gradient(90deg, #ffd700, #ff6b35, #dc3545, #ffd700) 1;
}

.fuel-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 10% 20%, rgba(255, 215, 0, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 90% 80%, rgba(220, 53, 69, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(255, 107, 53, 0.03) 0%, transparent 70%);
    pointer-events: none;
}

.fuel-footer .container-fluid {
    position: relative;
    z-index: 2;
}

.footer-section {
    background: rgba(255, 255, 255, 0.02);
    border-radius: 20px;
    padding: 30px 25px;
    margin-bottom: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.footer-section:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(220, 53, 69, 0.2);
    border-color: rgba(220, 53, 69, 0.3);
}

.footer-title {
    color: #ffd700 !important;
    font-weight: bold;
    font-size: 1.4rem;
    margin-bottom: 20px;
    position: relative;
    display: inline-block;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #ffd700, #ff6b35);
    border-radius: 2px;
}

.footer-text {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    text-align: justify;
    font-size: 0.95rem;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 12px;
    transition: all 0.3s ease;
}

.footer-links li a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 25px;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
    overflow: hidden;
}

.footer-links li a::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.2), transparent);
    transition: left 0.5s;
}

.footer-links li a:hover::before {
    left: 100%;
}

.footer-links li a:hover {
    color: #ffd700;
    background: rgba(220, 53, 69, 0.2);
    transform: translateX(10px);
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.map-container {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 20px;
    padding: 20px;
    margin: 20px 0;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.map-container h5 {
    color: #ffd700;
    font-weight: bold;
    margin-bottom: 15px;
}

.map-container iframe {
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
    max-width: 100%;
    height: 200px;
}

.map-container iframe:hover {
    transform: scale(1.02);
    box-shadow: 0 15px 40px rgba(220, 53, 69, 0.2);
}

.address-text {
    color: rgba(255, 255, 255, 0.9);
    font-style: italic;
    background: rgba(255, 215, 0, 0.1);
    padding: 10px 15px;
    border-radius: 15px;
    border-left: 4px solid #ffd700;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.social-links li {
    list-style: none;
}

.social-links li a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #dc3545, #ff6b35);
    color: white;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    position: relative;
    overflow: hidden;
}

.social-links li a::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, #ffd700, #ff6b35);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.social-links li a:hover::before {
    opacity: 1;
}

.social-links li a:hover {
    transform: translateY(-5px) scale(1.1);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
}

.social-links li a i {
    font-size: 1.2rem;
    position: relative;
    z-index: 2;
}

.footer-links-right a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 20px;
    transition: all 0.3s ease;
    display: inline-block;
    margin: 5px 0;
}

.footer-links-right a:hover {
    color: #ffd700;
    background: rgba(255, 215, 0, 0.1);
    transform: translateX(-10px);
}

.copyright-section {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 20px;
    padding: 20px;
    margin-top: 30px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.copyright-text {
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
}

.designer-credit {
    color: rgba(255, 255, 255, 0.7);
    margin: 0;
}

.designer-credit a {
    color: #ffd700;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
}

.designer-credit a:hover {
    color: #ff6b35;
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
}

/* Efectos de partículas flotantes */
.fuel-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: #ffd700;
    border-radius: 50%;
    opacity: 0.6;
    animation: float 6s infinite linear;
}

.particle:nth-child(2) { left: 20%; animation-delay: -2s; background: #ff6b35; }
.particle:nth-child(3) { left: 40%; animation-delay: -4s; background: #dc3545; }
.particle:nth-child(4) { left: 60%; animation-delay: -1s; background: #ffd700; }
.particle:nth-child(5) { left: 80%; animation-delay: -3s; background: #ff6b35; }

@keyframes float {
    0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 0.6;
    }
    90% {
        opacity: 0.6;
    }
    100% {
        transform: translateY(-100px) rotate(360deg);
        opacity: 0;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .footer-section {
        padding: 20px 15px;
        margin-bottom: 15px;
    }
    
    .map-container iframe {
        width: 100%;
        height: 180px;
    }
    
    .social-links {
        justify-content: center;
    }
    
    .footer-links-right {
        text-align: center !important;
    }
}
</style>

<footer class="fuel-footer pt-5 pb-3">
    <div class="fuel-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    
    <div class="container-fluid tm-container-small">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 px-3 mb-4">
                <div class="footer-section">
                    <h3 class="footer-title">Sobre Nosotros</h3>
                    <p class="footer-text">
                        <strong>MINICHUMBIE S.A.S</strong> es una empresa líder en Colombia, con sede principal en Bogotá D.C., especializada en el sector de Estaciones de Gasolina. Fundada el 30 de agosto de 2013, actualmente emplea a 22 personas (2024). 
                        <br><br>
                        En nuestros últimos aspectos financieros destacados, reportamos un aumento de ingresos netos del 16% en 2023, con un crecimiento del Activo Total del 400,32% y un incremento del margen neto del 0,08%.
                    </p>
                </div>
            </div>
            
            <div class=" col-md-6 px-3 mb-4">
                <div class="footer-section">
                    <h3 class="footer-title">Información de Contacto</h3>
                    <ul class="footer-links">
                        <li><a href="#">📢 Publicidad</a></li>
                        <li><a href="#">🛠️ Soporte Técnico</a></li>
                        <li><a href="#">🏢 Nuestra Empresa</a></li>
                    </ul>
                    
                    <div class="map-container text-center">
                        <h5>📍 Encuéntranos Aquí:</h5>
                        <div class="d-flex justify-content-center">
                            <iframe 
                              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.8906442256484!2d-74.19777498899172!3d4.788801295166491!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f821fe4dbeb3d%3A0xababc480cb8a0043!2sEstaci%C3%B3n%20de%20servicio%20Terpel%20La%20B%C3%A1scula%20(Peaje%20Siberia)!5e0!3m2!1sen!2sus!4v1744385608600!5m2!1sen!2sus" 
                              width="100%" 
                              height="200" 
                              style="border:0;" 
                              allowfullscreen="" 
                              loading="lazy" 
                              referrerpolicy="no-referrer-when-downgrade">
                            </iframe>   
                        </div>
                        <p class="address-text mt-3">📍 Calle 123 #45-67, Bogotá, Colombia</p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-7 col-12 px-5 mb-3 text-white">
                Copyright <?php echo date("Y"); ?>. All rights reserved.
            </div>
            <div class="col-lg-4 col-md-5 col-12 px-5  text-white">
                Designed by the w1zard 
            </div>
        </div>
    </div>
</footer>
