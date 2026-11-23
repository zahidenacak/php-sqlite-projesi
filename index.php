<?php
require_once __DIR__ . '/baglanti.php';

$db = get_db();
$db->exec("CREATE TABLE IF NOT EXISTS eserler (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    akim TEXT NOT NULL DEFAULT 'Empresyonizm',
    ressam TEXT NOT NULL,
    orijinal_ad TEXT NOT NULL,
    turkce_ad TEXT NOT NULL,
    yil INTEGER NOT NULL,
    UNIQUE(akim, ressam, orijinal_ad, yil)
)");

$kolonlar = $db->query("PRAGMA table_info(eserler)")->fetchAll();
$kolonAdlari = array_column($kolonlar, 'name');
if (!in_array('akim', $kolonAdlari, true)) {
    $db->exec("ALTER TABLE eserler ADD COLUMN akim TEXT NOT NULL DEFAULT 'Empresyonizm'");
}

$akimMeta = [
    'Rönesans' => [
        'donem' => '1400 – 1600',
        'renk' => '#8b3a2b',
        'aciklama' => 'Antik Yunan ve Roma mirasının yeniden keşfi, perspektif ustalığı ve insan merkezli doğa gözlemi.',
    ],
    'Barok' => [
        'donem' => '1600 – 1750',
        'renk' => '#6e4726',
        'aciklama' => 'Dramatik ışık-gölge (chiaroscuro) karşıtlıkları, hareket, duygu yoğunluğu ve görkemli kompozisyonlar.',
    ],
    'Romantizm' => [
        'donem' => '1780 – 1850',
        'renk' => '#2b4560',
        'aciklama' => 'Bireysel duygu, yüce doğa manzaraları, hayal gücü ve tarihsel dramların coşkulu anlatımı.',
    ],
    'Empresyonizm' => [
        'donem' => '1860 – 1890',
        'renk' => '#2c5e4f',
        'aciklama' => 'Açık havada anlık gün ışığı değişimlerini, atmosferi ve görünür fırça darbelerini yakalama arayışı.',
    ],
    'Post-Empresyonizm' => [
        'donem' => '1886 – 1905',
        'renk' => '#9c6615',
        'aciklama' => 'İzlenimciliğin ötesine geçerek sembolik renkler, geometrik biçimler ve yoğun içsel ifadeye yöneliş.',
    ],
    'Sürrealizm' => [
        'donem' => '1920 – 1960',
        'renk' => '#543864',
        'aciklama' => 'Bilinçaltı, rüya imgeleri ve mantığın sınırlarını aşan beklenmedik sembolik birleşimler.',
    ],
];

$gecerliAkimlar = array_keys($akimMeta);

$baslangicEserleri = [
    // Rönesans
    ['Rönesans', 'Leonardo da Vinci', 'La Gioconda (Mona Lisa)', 'Mona Lisa', 1503],
    ['Rönesans', 'Sandro Botticelli', 'La Nascita di Venere', 'Venüs’ün Doğuşu', 1485],
    ['Rönesans', 'Michelangelo', 'Creazione di Adamo', 'Adem’in Yaratılışı', 1512],
    ['Rönesans', 'Raffaello Sanzio', 'Scuola di Atene', 'Atina Okulu', 1511],
    ['Rönesans', 'Tiziano Vecellio', 'Venere di Urbino', 'Urbino Venüsü', 1538],
    ['Rönesans', 'Jan van Eyck', 'Portret van Giovanni Arnolfini en zijn vrouw', 'Arnolfini’nin Evlenmesi', 1434],
    ['Rönesans', 'Albrecht Dürer', 'Selbstbildnis im Pelzrock', 'Kürklü Otoportre', 1500],
    ['Rönesans', 'Hieronymus Bosch', 'Tuin der lusten', 'Dünyevi Zevkler Bahçesi', 1510],
    ['Rönesans', 'Pieter Bruegel', 'De val van Icarus', 'İkarus’un Düşüşü', 1558],
    ['Rönesans', 'Fra Angelico', 'Annunciazione', 'Müjde', 1442],
    ['Rönesans', 'Masaccio', 'La Trinità', 'Kutsal Üçlü', 1427],
    ['Rönesans', 'Piero della Francesca', 'Flagellazione di Cristo', 'İsa’nın Kırbaçlanması', 1455],
    ['Rönesans', 'Andrea Mantegna', 'Cristo morto', 'Ölü İsa’ya Ağıt', 1480],
    ['Rönesans', 'Giovanni Bellini', 'Doge Leonardo Loredan', 'Doge Leonardo Loredan Portresi', 1501],
    ['Rönesans', 'Giorgione', 'La Tempesta', 'Fırtına', 1508],
    ['Rönesans', 'Antonio da Correggio', 'Assunzione della Vergine', 'Meryem’in Göğe Yükselişi', 1530],
    ['Rönesans', 'Jacopo Tintoretto', 'Il miracolo dello schiavo', 'Kölenin Mucizesi', 1548],
    ['Rönesans', 'Paolo Veronese', 'Le Nozze di Cana', 'Kana’da Düğün', 1563],
    ['Rönesans', 'Hans Holbein', 'The Ambassadors', 'Elçiler', 1533],
    ['Rönesans', 'El Greco', 'El entierro del conde de Orgaz', 'Orgaz Kontu’nun Gömülmesi', 1588],

    // Barok
    ['Barok', 'Johannes Vermeer', 'Meisje met de parel', 'İnci Küpeli Kız', 1665],
    ['Barok', 'Rembrandt van Rijn', 'De Nachtwacht', 'Gece Devriyesi', 1642],
    ['Barok', 'Caravaggio', 'Vocazione di San Matteo', 'Aziz Matta’nın Çağrısı', 1600],
    ['Barok', 'Diego Velázquez', 'Las Meninas', 'Nedimeler', 1656],
    ['Barok', 'Peter Paul Rubens', 'De kruisafneming', 'Çarmıhtan İndiriliş', 1614],
    ['Barok', 'Artemisia Gentileschi', 'Giuditta che decapita Oloferne', 'Holofernes’i Öldüren Yudit', 1620],
    ['Barok', 'Nicolas Poussin', 'Et in Arcadia ego', 'Arkadyalı Çobanlar', 1638],
    ['Barok', 'Claude Lorrain', 'Port de mer au soleil couchant', 'Gün Batımında Liman', 1639],
    ['Barok', 'Frans Hals', 'De lachende cavalier', 'Gülen Süvari', 1624],
    ['Barok', 'Jan Steen', 'Het vrolijke huisgezin', 'Neşeli Aile', 1668],
    ['Barok', 'Jacob van Ruisdael', 'De molen bij Wijk bij Duurstede', 'Wijk bij Duurstede Yel Değirmeni', 1670],
    ['Barok', 'Anthony van Dyck', 'Charles I at the Hunt', 'I. Charles Avda', 1635],
    ['Barok', 'Georges de La Tour', 'La Madeleine à la veilleuse', 'Kandilli Mecdelli Meryem', 1640],
    ['Barok', 'Annibale Carracci', 'Il mangiafagioli', 'Fasulye Yiyen Adam', 1585],
    ['Barok', 'Guido Reni', 'Aurora', 'Şafak', 1614],
    ['Barok', 'Jusepe de Ribera', 'El martirio de San Felipe', 'Aziz Filipus’un Şehadeti', 1639],
    ['Barok', 'Francisco de Zurbarán', 'Agnus Dei', 'Tanrı’nın Kuzusu', 1640],
    ['Barok', 'Bartolomé Esteban Murillo', 'Niños comiendo uvas y melón', 'Üzüm ve Kavun Yiyen Çocuklar', 1650],
    ['Barok', 'Pieter de Hooch', 'De binnenplaats van een huis in Delft', 'Delft’te Bir Evin Avlusu', 1658],
    ['Barok', 'Judith Leyster', 'De vrolijke drinker', 'Neşeli İçici', 1629],

    // Romantizm
    ['Romantizm', 'Caspar David Friedrich', 'Der Wanderer über dem Nebelmeer', 'Bulutların Üzerinde Yolculuk', 1818],
    ['Romantizm', 'Eugène Delacroix', 'La Liberté guidant le peuple', 'Halka Yol Gösteren Özgürlük', 1830],
    ['Romantizm', 'Francisco Goya', 'El tres de mayo de 1808 en Madrid', '3 Mayıs 1808', 1814],
    ['Romantizm', 'Théodore Géricault', 'Le Radeau de La Méduse', 'Medusa’nın Salı', 1819],
    ['Romantizm', 'J.M.W. Turner', 'The Fighting Temeraire', 'Savaşan Temeraire', 1839],
    ['Romantizm', 'John Constable', 'The Hay Wain', 'Saman Arabası', 1821],
    ['Romantizm', 'William Blake', 'The Ancient of Days', 'Günlerin Eskisi', 1794],
    ['Romantizm', 'Henry Fuseli', 'The Nightmare', 'Kâbus', 1781],
    ['Romantizm', 'Jean-Auguste-Dominique Ingres', 'La Grande Odalisque', 'Büyük Odalık', 1814],
    ['Romantizm', 'Francesco Hayez', 'Il bacio', 'Öpücük', 1859],
    ['Romantizm', 'İvan Ayvazovski', 'Devyaty val', 'Dokuzuncu Dalga', 1850],
    ['Romantizm', 'Karl Bryullov', 'Posledniy den Pompei', 'Pompei’nin Son Günü', 1833],
    ['Romantizm', 'Philipp Otto Runge', 'Die Hülsenbeckschen Kinder', 'Hülsenbeck Çocukları', 1806],
    ['Romantizm', 'Thomas Cole', 'The Oxbow', 'Menderes', 1836],
    ['Romantizm', 'Frederic Edwin Church', 'The Heart of the Andes', 'And Dağları’nın Kalbi', 1859],
    ['Romantizm', 'Albert Bierstadt', 'Among the Sierra Nevada, California', 'Sierra Nevada Dağları Arasında', 1868],
    ['Romantizm', 'George Stubbs', 'Whistlejacket', 'Whistlejacket', 1762],
    ['Romantizm', 'Antoine-Jean Gros', 'Bonaparte visitant les pestiférés de Jaffa', 'Bonaparte Yafa Vebalılarını Ziyaret Ederken', 1804],
    ['Romantizm', 'Carl Spitzweg', 'Der arme Poet', 'Yoksul Şair', 1839],
    ['Romantizm', 'Samuel Palmer', 'In a Shoreham Garden', 'Shoreham Bahçesinde', 1829],

    // Empresyonizm
    ['Empresyonizm', 'Claude Monet', 'Impression, soleil levant', 'İzlenim: Gün Doğumu', 1872],
    ['Empresyonizm', 'Claude Monet', 'Nymphéas', 'Nilüferler', 1906],
    ['Empresyonizm', 'Pierre-Auguste Renoir', 'Bal du moulin de la Galette', 'Moulin de la Galette Balosu', 1876],
    ['Empresyonizm', 'Edgar Degas', 'La Classe de danse', 'Dans Dersi', 1874],
    ['Empresyonizm', 'Berthe Morisot', 'Le Berceau', 'Beşik', 1872],
    ['Empresyonizm', 'Camille Pissarro', 'Boulevard Montmartre, effet de nuit', 'Montmartre Bulvarı, Gece Etkisi', 1897],
    ['Empresyonizm', 'Alfred Sisley', 'L’Inondation à Port-Marly', 'Port-Marly’de Sel', 1876],
    ['Empresyonizm', 'Mary Cassatt', 'The Child’s Bath', 'Çocuğun Banyosu', 1893],
    ['Empresyonizm', 'Gustave Caillebotte', 'Rue de Paris, temps de pluie', 'Yağmurlu Bir Günde Paris Sokağı', 1877],
    ['Empresyonizm', 'Édouard Manet', 'Un bar aux Folies Bergère', 'Folies Bergère’de Bir Bar', 1882],
    ['Empresyonizm', 'Frédéric Bazille', 'Réunion de famille', 'Aile Toplantısı', 1867],
    ['Empresyonizm', 'Armand Guillaumin', 'Soleil couchant à Ivry', 'Ivry’de Gün Batımı', 1873],
    ['Empresyonizm', 'Eva Gonzalès', 'Une loge aux Italiens', 'İtalyan Tiyatrosu’nda Bir Loca', 1874],
    ['Empresyonizm', 'Marie Bracquemond', 'Sur la terrasse à Sèvres', 'Sèvres Terasında', 1880],
    ['Empresyonizm', 'Childe Hassam', 'The Avenue in the Rain', 'Yağmurda Bulvar', 1917],
    ['Empresyonizm', 'John Singer Sargent', 'Carnation, Lily, Lily, Rose', 'Karanfil, Zambak, Zambak, Gül', 1885],
    ['Empresyonizm', 'Joaquín Sorolla', 'Paseo a orillas del mar', 'Deniz Kıyısında Yürüyüş', 1909],
    ['Empresyonizm', 'Max Liebermann', 'Gartenlokal an der Havel', 'Havel Kıyısında Bahçe Lokantası', 1916],
    ['Empresyonizm', 'Lovis Corinth', 'Walchensee', 'Walchen Gölü', 1923],
    ['Empresyonizm', 'Konstantin Korovin', 'Parizhskiy bulvar nochyu', 'Gece Paris Bulvarı', 1906],

    // Post-Empresyonizm
    ['Post-Empresyonizm', 'Vincent van Gogh', 'De sterrennacht', 'Yıldızlı Gece', 1889],
    ['Post-Empresyonizm', 'Vincent van Gogh', 'Sunflowers', 'Ayçiçekleri', 1888],
    ['Post-Empresyonizm', 'Paul Cézanne', 'Les Joueurs de cartes', 'İskambil Oynayanlar', 1895],
    ['Post-Empresyonizm', 'Paul Gauguin', 'D’où venons-nous ? Que sommes-nous ? Où allons-nous ?', 'Nereden Geliyoruz? Neyiz? Nereye Gidiyoruz?', 1897],
    ['Post-Empresyonizm', 'Georges Seurat', 'Un dimanche après-midi à l’Île de la Grande Jatte', 'Grande Jatte Adası’nda Bir Pazar Öğleden Sonrası', 1884],
    ['Post-Empresyonizm', 'Henri de Toulouse-Lautrec', 'Au Moulin Rouge', 'Moulin Rouge’da', 1895],
    ['Post-Empresyonizm', 'Paul Signac', 'Le Pin de Saint-Tropez', 'Saint-Tropez Çamı', 1909],
    ['Post-Empresyonizm', 'Émile Bernard', 'Les Bretonnes dans la prairie', 'Çayırdaki Breton Kadınları', 1888],
    ['Post-Empresyonizm', 'Henri Rousseau', 'La Bohémienne endormie', 'Uyuyan Çingene', 1897],
    ['Post-Empresyonizm', 'Pierre Bonnard', 'La Terrasse à Vernon', 'Vernon’da Teras', 1928],
    ['Post-Empresyonizm', 'Édouard Vuillard', 'Les Jardins publics', 'Halk Bahçeleri', 1894],
    ['Post-Empresyonizm', 'Odilon Redon', 'Le Cyclope', 'Tepegöz', 1914],
    ['Post-Empresyonizm', 'Maurice Denis', 'Les Muses', 'İlham Perileri', 1893],
    ['Post-Empresyonizm', 'Félix Vallotton', 'Le Ballon', 'Top', 1899],
    ['Post-Empresyonizm', 'Suzanne Valadon', 'La Chambre bleue', 'Mavi Oda', 1923],
    ['Post-Empresyonizm', 'Theo van Rysselberghe', 'La Lecture', 'Okuma', 1903],
    ['Post-Empresyonizm', 'Maximilien Luce', 'Le Quai Saint-Michel et Notre-Dame', 'Saint-Michel Rıhtımı ve Notre-Dame', 1901],
    ['Post-Empresyonizm', 'Charles Angrand', 'Couple dans la rue', 'Sokaktaki Çift', 1887],
    ['Post-Empresyonizm', 'Paul Sérusier', 'Le Talisman', 'Tılsım', 1888],
    ['Post-Empresyonizm', 'Ker-Xavier Roussel', 'L’Après-midi d’un faune', 'Bir Faun’un Öğleden Sonrası', 1919],

    // Sürrealizm
    ['Sürrealizm', 'Salvador Dalí', 'La persistencia de la memoria', 'Belleğin Azmi', 1931],
    ['Sürrealizm', 'René Magritte', 'Le Fils de l’homme', 'İnsanoğlu', 1964],
    ['Sürrealizm', 'Frida Kahlo', 'Las dos Fridas', 'İki Frida', 1939],
    ['Sürrealizm', 'Max Ernst', 'L’Éléphant Célèbes', 'Celebes Fili', 1921],
    ['Sürrealizm', 'Joan Miró', 'El carnaval de Arlequín', 'Soytarının Karnavalı', 1925],
    ['Sürrealizm', 'Yves Tanguy', 'Multiplication des arcs', 'Yayların Çoğalması', 1954],
    ['Sürrealizm', 'Giorgio de Chirico', 'Mistero e malinconia di una strada', 'Bir Sokağın Gizemi ve Melankolisi', 1914],
    ['Sürrealizm', 'Remedios Varo', 'Creación de las aves', 'Kuşların Yaratılışı', 1957],
    ['Sürrealizm', 'Leonora Carrington', 'Self-Portrait (Inn of the Dawn Horse)', 'Şafak Atı Hanı Otoportresi', 1938],
    ['Sürrealizm', 'Dorothea Tanning', 'Eine kleine Nachtmusik', 'Küçük Bir Gece Müziği', 1943],
    ['Sürrealizm', 'Kay Sage', 'Tomorrow Is Never', 'Yarın Hiçbir Zamandır', 1955],
    ['Sürrealizm', 'Paul Delvaux', 'La Gare forestière', 'Orman İstasyonu', 1960],
    ['Sürrealizm', 'André Masson', 'Bataille de poissons', 'Balıkların Savaşı', 1926],
    ['Sürrealizm', 'Marc Chagall', 'Moi et le Village', 'Ben ve Köy', 1911],
    ['Sürrealizm', 'Wifredo Lam', 'La Jungla', 'Orman', 1943],
    ['Sürrealizm', 'Roberto Matta', 'Invasion of the Night', 'Gecenin İstilası', 1941],
    ['Sürrealizm', 'Victor Brauner', 'Loup-table', 'Kurt-Masa', 1947],
    ['Sürrealizm', 'Óscar Domínguez', 'La Máquina de coser electro-sexual', 'Elektro-Seksüel Dikiş Makinesi', 1934],
    ['Sürrealizm', 'Toyen', 'Spící', 'Uyuyan Kız', 1937],
    ['Sürrealizm', 'Leonor Fini', 'La Bout du monde', 'Dünyanın Sonu', 1948],
];

$ekleStmt = $db->prepare("INSERT OR IGNORE INTO eserler (akim, ressam, orijinal_ad, turkce_ad, yil)
    VALUES (:akim, :ressam, :orijinal_ad, :turkce_ad, :yil)");

foreach ($baslangicEserleri as $eser) {
    $ekleStmt->execute([
        ':akim' => $eser[0],
        ':ressam' => $eser[1],
        ':orijinal_ad' => $eser[2],
        ':turkce_ad' => $eser[3],
        ':yil' => $eser[4],
    ]);
}

$seciliAkimFiltre = trim($_GET['akim'] ?? '');
if (!in_array($seciliAkimFiltre, $gecerliAkimlar, true)) {
    $seciliAkimFiltre = '';
}

$mesaj = '';
$hata = '';

// Silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['islem'] ?? '') === 'sil') {
    $silId = (int) ($_POST['id'] ?? 0);
    $donusAkim = trim($_POST['donus_akim'] ?? '');
    if ($silId > 0) {
        $stmt = $db->prepare("DELETE FROM eserler WHERE id = :id");
        $stmt->execute([':id' => $silId]);
        $query = in_array($donusAkim, $gecerliAkimlar, true)
            ? '?akim=' . urlencode($donusAkim) . '&durum=silindi'
            : '?durum=silindi';
        header('Location: ' . $_SERVER['PHP_SELF'] . $query);
        exit;
    }
}

// Ekleme veya Güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array(($_POST['islem'] ?? ''), ['ekle', 'guncelle'], true)) {
    $islem = $_POST['islem'];
    $id = (int) ($_POST['id'] ?? 0);
    $akim = trim($_POST['akim'] ?? '');
    $ressam = trim($_POST['ressam'] ?? '');
    $orijinalAd = trim($_POST['orijinal_ad'] ?? '');
    $turkceAd = trim($_POST['turkce_ad'] ?? '');
    $yil = (int) ($_POST['yil'] ?? 0);

    $gecersizAkim = !in_array($akim, $gecerliAkimlar, true);
    $bosAlan = ($ressam === '' or $orijinalAd === '' or $turkceAd === '');
    $gecersizYil = ($yil < 1300 or $yil > 2026);

    if ($gecersizAkim or $bosAlan or $gecersizYil) {
        $hata = 'Lütfen sanat akımı dahil tüm alanları eksiksiz doldurun ve geçerli bir yıl (1300–2026) girin.';
    } else {
        try {
            if ($islem === 'guncelle' && $id > 0) {
                $stmt = $db->prepare("UPDATE eserler
                    SET akim = :akim, ressam = :ressam, orijinal_ad = :orijinal_ad, turkce_ad = :turkce_ad, yil = :yil
                    WHERE id = :id");
                $stmt->execute([
                    ':id' => $id,
                    ':akim' => $akim,
                    ':ressam' => $ressam,
                    ':orijinal_ad' => $orijinalAd,
                    ':turkce_ad' => $turkceAd,
                    ':yil' => $yil,
                ]);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?akim=' . urlencode($akim) . '&durum=guncellendi');
                exit;
            }

            if ($islem === 'ekle') {
                $kontrolStmt = $db->prepare("SELECT COUNT(*) FROM eserler
                    WHERE LOWER(akim) = LOWER(:akim)
                      AND LOWER(ressam) = LOWER(:ressam)
                      AND LOWER(orijinal_ad) = LOWER(:orijinal_ad)
                      AND yil = :yil");
                $kontrolStmt->execute([
                    ':akim' => $akim,
                    ':ressam' => $ressam,
                    ':orijinal_ad' => $orijinalAd,
                    ':yil' => $yil,
                ]);

                if ((int) $kontrolStmt->fetchColumn() > 0) {
                    $hata = 'Bu eser koleksiyonda zaten mevcut.';
                } else {
                    $stmt = $db->prepare("INSERT INTO eserler (akim, ressam, orijinal_ad, turkce_ad, yil)
                        VALUES (:akim, :ressam, :orijinal_ad, :turkce_ad, :yil)");
                    $stmt->execute([
                        ':akim' => $akim,
                        ':ressam' => $ressam,
                        ':orijinal_ad' => $orijinalAd,
                        ':turkce_ad' => $turkceAd,
                        ':yil' => $yil,
                    ]);
                    header('Location: ' . $_SERVER['PHP_SELF'] . '?akim=' . urlencode($akim) . '&durum=eklendi');
                    exit;
                }
            }
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'UNIQUE')) {
                $hata = 'Bu eser koleksiyonda zaten mevcut.';
            } else {
                $hata = 'Veritabanı işlemi sırasında bir hata oluştu.';
            }
        }
    }
}

// Düzenlenecek kaydı getir
$duzenlenenEser = null;
if (isset($_GET['duzenle'])) {
    $duzenleId = (int) $_GET['duzenle'];
    if ($duzenleId > 0) {
        $stmt = $db->prepare("SELECT id, akim, ressam, orijinal_ad, turkce_ad, yil FROM eserler WHERE id = :id");
        $stmt->execute([':id' => $duzenleId]);
        $duzenlenenEser = $stmt->fetch() ?: null;
        if ($duzenlenenEser && $seciliAkimFiltre === '') {
            $seciliAkimFiltre = $duzenlenenEser['akim'];
        }
    }
}

if (isset($_GET['durum'])) {
    $mesaj = match ($_GET['durum']) {
        'eklendi' => 'Yeni eser koleksiyona eklendi.',
        'guncellendi' => 'Eser bilgileri güncellendi.',
        'silindi' => 'Eser kaydı koleksiyondan kaldırıldı.',
        default => '',
    };
}

// Her akımın eser sayısını hesapla
$sayacSorgu = $db->query("SELECT akim, COUNT(*) AS adet FROM eserler GROUP BY akim")->fetchAll();
$akimSayilari = array_fill_keys($gecerliAkimlar, 0);
$toplamKayit = 0;
foreach ($sayacSorgu as $satir) {
    if (isset($akimSayilari[$satir['akim']])) {
        $akimSayilari[$satir['akim']] = (int) $satir['adet'];
        $toplamKayit += (int) $satir['adet'];
    }
}

// Yalnızca seçilen akımın eserlerini çek
$seciliEserler = [];
if ($seciliAkimFiltre !== '') {
    $stmt = $db->prepare("SELECT id, akim, ressam, orijinal_ad, turkce_ad, yil FROM eserler WHERE akim = :akim ORDER BY yil ASC, id ASC");
    $stmt->execute([':akim' => $seciliAkimFiltre]);
    $seciliEserler = $stmt->fetchAll();
}

$aktifRenk = $seciliAkimFiltre !== '' ? $akimMeta[$seciliAkimFiltre]['renk'] : '#2c5e4f';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanat Akımları Kataloğu</title>
    <style>
        :root {
            --bg: #f4f1ea;
            --canvas: #fffdf9;
            --surface: #faf7f0;
            --ink: #1c1b19;
            --muted: #666159;
            --border: #e3dcd0;
            --brass: #9a7b4f;
            --active-accent: <?= htmlspecialchars($aktifRenk) ?>;
            --danger: #9e3333;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 36px 20px 56px;
            font-family: "Segoe UI", system-ui, -apple-system, sans-serif;
            background-color: var(--bg);
            background-image: radial-gradient(rgba(154, 123, 79, 0.09) 1px, transparent 0);
            background-size: 24px 24px;
            color: var(--ink);
            line-height: 1.55;
        }
        .container { max-width: 1160px; margin: 0 auto; }
        .gallery-header {
            text-align: center;
            padding-bottom: 24px;
            margin-bottom: 26px;
            border-bottom: 1px solid var(--border);
        }
        .gallery-header::after {
            content: "";
            display: block;
            width: 72px;
            height: 2px;
            background: var(--brass);
            margin: 16px auto -25px;
        }
        .eyebrow {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--brass);
            margin-bottom: 6px;
        }
        h1 {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 2.35rem;
            font-weight: 700;
            color: var(--ink);
        }
        .subtitle { margin: 8px 0 0; color: var(--muted); font-size: 0.94rem; }
        .card {
            background: var(--canvas);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px 24px;
            margin-bottom: 22px;
            box-shadow: 0 8px 24px rgba(28, 27, 25, 0.04);
        }
        .card-title {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--ink);
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            gap: 12px;
            flex-wrap: wrap;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1.15fr 1.25fr 1.4fr 1.4fr 0.75fr;
            gap: 12px;
        }
        .form-grid input, .form-grid select {
            width: 100%;
            padding: 10px 13px;
            border: 1px solid #d9d0c1;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.92rem;
            background: var(--surface);
            color: var(--ink);
        }
        .form-grid input:focus, .form-grid select:focus {
            outline: none;
            border-color: var(--brass);
            background: #fff;
        }
        .form-actions { margin-top: 14px; display: flex; gap: 10px; align-items: center; }
        button, .btn-link {
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.15s ease;
        }
        .btn-primary { background: var(--ink); color: #fffdf9; }
        .btn-primary:hover { background: #33312d; }
        .btn-secondary { background: #ede7dc; color: var(--ink); }
        .btn-secondary:hover { background: #e2dacb; }
        .movement-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .movement-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 16px 18px;
            border: 1px solid var(--border);
            border-left: 4px solid var(--card-accent);
            border-radius: 10px;
            background: var(--surface);
            color: var(--ink);
            text-decoration: none;
            transition: all 0.18s ease;
        }
        .movement-card:hover { background: #fff; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(28, 27, 25, 0.06); }
        .movement-card.active { background: var(--card-accent); border-color: var(--card-accent); color: #fffdf9; }
        .movement-name { font-family: Georgia, "Times New Roman", serif; font-size: 1.25rem; font-weight: 700; }
        .movement-period { font-size: 0.78rem; color: var(--muted); margin-top: 2px; }
        .movement-card.active .movement-period { color: rgba(255, 253, 249, 0.85); }
        .movement-badge {
            align-self: flex-start;
            margin-top: 10px;
            font-size: 0.76rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 999px;
            background: rgba(28, 27, 25, 0.06);
            color: var(--ink);
        }
        .movement-card.active .movement-badge { background: rgba(255, 253, 249, 0.22); color: #fffdf9; }
        .exhibition-banner {
            padding: 18px 20px;
            border-radius: 10px;
            background: var(--surface);
            border-left: 4px solid var(--active-accent);
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .exhibition-title { margin: 0; font-family: Georgia, "Times New Roman", serif; font-size: 1.65rem; font-weight: 700; color: var(--active-accent); }
        .exhibition-desc { margin: 6px 0 0; color: var(--muted); font-size: 0.92rem; max-width: 760px; }
        .exhibition-pill { font-size: 0.82rem; font-weight: 600; padding: 6px 14px; border-radius: 999px; background: var(--active-accent); color: #fffdf9; white-space: nowrap; }
        .empty-state { text-align: center; padding: 44px 16px; color: var(--muted); }
        .empty-state-title { font-family: Georgia, "Times New Roman", serif; font-size: 1.4rem; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 0.92rem; }
        th, td { padding: 12px 14px; text-align: left; border-bottom: 1px solid var(--border); vertical-align: middle; }
        th { color: var(--muted); font-weight: 600; font-size: 0.74rem; text-transform: uppercase; letter-spacing: 0.08em; background: var(--surface); white-space: nowrap; }
        tbody tr:hover { background: #fbf8f2; }
        .col-id { color: var(--muted); font-size: 0.84rem; width: 52px; }
        .col-artist { font-weight: 600; color: var(--ink); }
        .col-original { font-family: Georgia, "Times New Roman", serif; font-style: italic; font-size: 1.04rem; color: #2b2926; }
        .year-tag { display: inline-block; padding: 2px 9px; border-radius: 6px; background: #f1ece2; color: var(--ink); font-size: 0.83rem; font-weight: 600; }
        .actions-cell { display: flex; gap: 8px; white-space: nowrap; }
        .inline-form { display: inline; margin: 0; }
        .btn-edit { background: #efeae0; color: var(--ink); padding: 5px 11px; font-size: 0.8rem; }
        .btn-edit:hover { background: #e3dccf; }
        .btn-delete { background: #faeded; color: var(--danger); padding: 5px 11px; font-size: 0.8rem; }
        .btn-delete:hover { background: #f3dada; }
        .alert { padding: 12px 18px; border-radius: 10px; margin-bottom: 18px; font-size: 0.92rem; font-weight: 500; }
        .alert-success { background: #ebf4ef; color: #21493d; border: 1px solid #c6dfd3; }
        .alert-error { background: #fbeded; color: var(--danger); border: 1px solid #ebc7c7; }
        @media (max-width: 860px) {
            .movement-grid, .form-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 560px) {
            .movement-grid, .form-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="gallery-header">
            <span class="eyebrow">Dijital Sanat Koleksiyonu</span>
            <h1>Sanat Akımları Kataloğu</h1>
            <p class="subtitle"><?= count($gecerliAkimlar) ?> dönem akımı • Arşivde toplam <?= $toplamKayit ?> seçkin eser</p>
        </header>

        <?php if ($mesaj !== ''): ?>
            <div class="alert alert-success"><?= htmlspecialchars($mesaj) ?></div>
        <?php endif; ?>

        <?php if ($hata !== ''): ?>
            <div class="alert alert-error"><?= htmlspecialchars($hata) ?></div>
        <?php endif; ?>

        <section class="card">
            <div class="section-header" style="margin-bottom: 12px;">
                <h2 class="card-title">
                    <?= $duzenlenenEser ? 'Eser Kaydını Düzenle (#' . (int) $duzenlenenEser['id'] . ')' : 'Koleksiyona Yeni Eser Ekle' ?>
                </h2>
            </div>

            <form method="post">
                <input type="hidden" name="islem" value="<?= $duzenlenenEser ? 'guncelle' : 'ekle' ?>">
                <?php if ($duzenlenenEser): ?>
                    <input type="hidden" name="id" value="<?= (int) $duzenlenenEser['id'] ?>">
                <?php endif; ?>

                <div class="form-grid">
                    <?php $formSeciliAkim = $duzenlenenEser['akim'] ?? ($seciliAkimFiltre !== '' ? $seciliAkimFiltre : 'Empresyonizm'); ?>
                    <select name="akim" required>
                        <?php foreach ($gecerliAkimlar as $akimSecenek): ?>
                            <option value="<?= htmlspecialchars($akimSecenek) ?>" <?= $formSeciliAkim === $akimSecenek ? 'selected' : '' ?>>
                                <?= htmlspecialchars($akimSecenek) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input
                        type="text"
                        name="ressam"
                        placeholder="Ressam (örn. Claude Monet)"
                        value="<?= htmlspecialchars($duzenlenenEser['ressam'] ?? '') ?>"
                        required
                    >
                    <input
                        type="text"
                        name="orijinal_ad"
                        placeholder="Orijinal Eser Adı"
                        value="<?= htmlspecialchars($duzenlenenEser['orijinal_ad'] ?? '') ?>"
                        required
                    >
                    <input
                        type="text"
                        name="turkce_ad"
                        placeholder="Türkçe Eser Adı"
                        value="<?= htmlspecialchars($duzenlenenEser['turkce_ad'] ?? '') ?>"
                        required
                    >
                    <input
                        type="number"
                        name="yil"
                        placeholder="Yıl (1872)"
                        min="1300"
                        max="2026"
                        value="<?= htmlspecialchars((string) ($duzenlenenEser['yil'] ?? '')) ?>"
                        required
                    >
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <?= $duzenlenenEser ? 'Değişiklikleri Kaydet' : 'Eser Ekle' ?>
                    </button>
                    <?php if ($duzenlenenEser): ?>
                        <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) . ($seciliAkimFiltre !== '' ? '?akim=' . urlencode($seciliAkimFiltre) : '') ?>" class="btn-link btn-secondary">İptal</a>
                    <?php endif; ?>
                </div>
            </form>
        </section>

        <section class="card">
            <div class="section-header">
                <h2 class="card-title">Sanat Akımı Seçin</h2>
                <?php if ($seciliAkimFiltre !== ''): ?>
                    <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="btn-link btn-secondary" style="padding: 6px 12px; font-size: 0.82rem;">Seçimi Temizle</a>
                <?php endif; ?>
            </div>

            <div class="movement-grid">
                <?php foreach ($akimMeta as $akimAdi => $bilgi): ?>
                    <a
                        href="?akim=<?= urlencode($akimAdi) ?>"
                        class="movement-card <?= $seciliAkimFiltre === $akimAdi ? 'active' : '' ?>"
                        style="--card-accent: <?= htmlspecialchars($bilgi['renk']) ?>;"
                    >
                        <div>
                            <div class="movement-name"><?= htmlspecialchars($akimAdi) ?></div>
                            <div class="movement-period"><?= htmlspecialchars($bilgi['donem']) ?></div>
                        </div>
                        <span class="movement-badge"><?= $akimSayilari[$akimAdi] ?> eser</span>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="card">
            <?php if ($seciliAkimFiltre === ''): ?>
                <div class="empty-state">
                    <div class="empty-state-title">Bir Sergi Salonu Seçin</div>
                    Eserleri incelemek için yukarıdaki sanat akımı kartlarından birine tıklayın.
                </div>
            <?php else: ?>
                <div class="exhibition-banner">
                    <div>
                        <h2 class="exhibition-title"><?= htmlspecialchars($seciliAkimFiltre) ?></h2>
                        <p class="exhibition-desc"><?= htmlspecialchars($akimMeta[$seciliAkimFiltre]['aciklama']) ?></p>
                    </div>
                    <span class="exhibition-pill">
                        <?= htmlspecialchars($akimMeta[$seciliAkimFiltre]['donem']) ?> • <?= count($seciliEserler) ?> eser
                    </span>
                </div>

                <?php if (count($seciliEserler) === 0): ?>
                    <div class="empty-state">Bu sanat akımında henüz kayıtlı eser bulunmuyor.</div>
                <?php else: ?>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Ressam</th>
                                    <th>Orijinal Eser Adı</th>
                                    <th>Türkçe Adı</th>
                                    <th>Yıl</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($seciliEserler as $eser): ?>
                                    <tr>
                                        <td class="col-id">#<?= (int) $eser['id'] ?></td>
                                        <td class="col-artist"><?= htmlspecialchars($eser['ressam']) ?></td>
                                        <td class="col-original"><?= htmlspecialchars($eser['orijinal_ad']) ?></td>
                                        <td><?= htmlspecialchars($eser['turkce_ad']) ?></td>
                                        <td><span class="year-tag"><?= (int) $eser['yil'] ?></span></td>
                                        <td class="actions-cell">
                                            <a href="?akim=<?= urlencode($seciliAkimFiltre) ?>&duzenle=<?= (int) $eser['id'] ?>" class="btn-link btn-edit">Düzenle</a>
                                            <form method="post" class="inline-form" onsubmit="return confirm('Bu kaydı silmek istediğinize emin misiniz?');">
                                                <input type="hidden" name="islem" value="sil">
                                                <input type="hidden" name="id" value="<?= (int) $eser['id'] ?>">
                                                <input type="hidden" name="donus_akim" value="<?= htmlspecialchars($seciliAkimFiltre) ?>">
                                                <button type="submit" class="btn-delete">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>