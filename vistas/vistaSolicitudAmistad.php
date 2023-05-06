<h2>Solicitudes de amistad recibidas:</h2>

<?php if (count($solicitudesRecibidas) > 0): ?>

    <ul>
        <?php foreach ($solicitudesRecibidas as $solicitud): ?>
            <li>
                <strong><?php echo $solicitud->getUsuarioEmisor()->getNombreCompleto(); ?></strong> quiere ser tu amigo/a.
                <form action="index.php?accion=aceptar_solicitud" method="post">
                    <input type="hidden" name="id_solicitud" value="<?php echo $solicitud->getId(); ?>">
                    <button type="submit">Aceptar</button>
                </form>
                <form action="index.php?accion=rechazar_solicitud" method="post">
                    <input type="hidden" name="id_solicitud" value="<?php echo $solicitud->getId(); ?>">
                    <button type="submit">Rechazar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

<?php else: ?>

    <p>No tienes solicitudes de amistad pendientes.</p>

<?php endif; ?>

<h2>Solicitudes de amistad enviadas:</h2>

<?php if (count($solicitudesEnviadas) > 0): ?>

    <ul>
        <?php foreach ($solicitudesEnviadas as $solicitud): ?>
            <li>Has enviado una solicitud de amistad a <strong><?php echo $solicitud->getUsuarioReceptor()->getNombreCompleto(); ?></strong>.</li>
        <?php endforeach; ?>
    </ul>

<?php else: ?>

    <p>No has enviado ninguna solicitud de amistad.</p>

<?php endif; ?>
