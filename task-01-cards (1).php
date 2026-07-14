<?php
// Al-Aqsa University - Web Development 1
// Week 11 - Task 01: Profile Card Generator
// ===========================================
// In this task, you will build a profile card generator using PHP arrays,
// functions, loops, and conditionals. Complete all 6 TODOs below.

// ============================================================
// TODO 1: Create an associative array of 5 people
// ============================================================
// Each person should have: name, role, skills (array), image_url
// Roles should be: "Developer", "Designer", "Manager", "Analyst", "Tester"
//
// Example structure:
// $people = [
//     [
//         "name"      => "Ahmad Hassan",
//         "role"      => "Developer",
//         "skills"    => ["PHP", "MySQL", "JavaScript"],
//         "image_url" => "https://i.pravatar.cc/150?img=1"
//     ],
//     // ... 4 more people
// ];

$people = [
    [
        "name" => "Ahmad Hassan",
        "role" => "Developer",
        "skills" => ["PHP", "MySQL", "JavaScript"],
        "image_url" => "https://i.pravatar.cc/150?img=1"
    ],

    [
        "name" => "Sara Ali",
        "role" => "Designer",
        "skills" => ["Figma", "UI Design", "Photoshop"],
        "image_url" => "https://i.pravatar.cc/150?img=2"
    ],

    [
        "name" => "Omar Mahmoud",
        "role" => "Manager",
        "skills" => ["Leadership", "Planning", "Teamwork"],
        "image_url" => "https://i.pravatar.cc/150?img=3"
    ],

    [
        "name" => "Layla Ahmed",
        "role" => "Analyst",
        "skills" => ["Data Analysis", "Excel", "Statistics"],
        "image_url" => "https://i.pravatar.cc/150?img=4"
    ],

    [
        "name" => "Khaled Naser",
        "role" => "Tester",
        "skills" => ["Testing", "QA", "Debugging"],
        "image_url" => "https://i.pravatar.cc/150?img=5"
    ]
]; // <-- Replace this with your array of 5 people


// ============================================================
// TODO 2: Create a function renderCard($person) that returns an HTML card
// ============================================================
// The function should:
// - Accept a person associative array as parameter
// - Return an HTML string with a styled card
// - Display: image, name, role, and skills (as comma-separated list)
// - Use the card color from TODO 4
//
function renderCard(array $person): string {


    $color = getCardColor($person["role"]);


    $skills = implode(", ", $person["skills"]);



    return '

    <div class="card">

        <div class="card-color-bar" 
        style="background:' . $color . '">
        </div>


        <div class="card-body">

            <img src="'.$person["image_url"].'">


            <h3>'.$person["name"].'</h3>


            <div class="role"
            style="background:'.$color.'">
            
            '.$person["role"].'

            </div>


            <p class="skills">
            
            '.$skills.'

            </p>


        </div>

    </div>

    ';


}



// ============================================================
// TODO 3: Use foreach to loop through $people and display all cards
// ============================================================
// - Loop through the $people array
// - Call renderCard() for each person
// - Output the returned HTML
// (This will be done in the HTML section below)


// ============================================================
// TODO 4: Create a function getCardColor($role) that returns a color based on role
// ============================================================
// Use if/else or match to assign different colors:
// - Developer -> "#7c4dff" (purple)
// - Designer  -> "#ff4081" (pink)
// - Manager   -> "#00bfa5" (teal)
// - Analyst   -> "#ff6d00" (orange)
// - Tester    -> "#2979ff" (blue)
// - default   -> "#757575" (gray)
//
function getCardColor(string $role): string {

    return match($role){

        "Developer" => "#7c4dff",

        "Designer" => "#ff4081",

        "Manager" => "#00bfa5",

        "Analyst" => "#ff6d00",

        "Tester" => "#2979ff",

        default => "#757575"
    };

}




// ============================================================
// TODO 5: Display total count and current date
// ============================================================
// - Use count() to get the total number of people
// - Use date() to display the current date in format: "March 26, 2026"
//
$totalPeople = count($people);

$currentDate = date("F j, Y");



// ============================================================
// TODO 6: Add a search form (GET method) that filters cards by name
// ============================================================
// - Create a search form with method="GET" and an input named "search"
// - Get the search query from $_GET["search"]
// - Filter the $people array to only show matching names (case-insensitive)
// - Use stripos() or str_contains() for partial matching
//
$searchQuery = $_GET["search"] ?? "";


if(!empty($searchQuery)){


    $people = array_filter($people,function($person) use ($searchQuery){

        return stripos($person["name"], $searchQuery) !== false;

    });


}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 01 - Profile Card Generator</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0f0f1a;
            color: #e0e0e0;
            line-height: 1.6;
            min-height: 100vh;
        }
        .header {
            background: linear-gradient(135deg, #1a1a2e, #2d1b3d);
            padding: 30px 20px;
            text-align: center;
            border-bottom: 3px solid #ce93d8;
        }
        .header .logo-row {
            display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 10px;
        }
        .header h1 { font-size: 1.8rem; color: #fff; margin-bottom: 5px; }
        .header h1 span { color: #ce93d8; }
        .header p { color: #aaa; font-size: 0.95rem; }

        .container { max-width: 1100px; margin: 0 auto; padding: 30px 20px; }

        .stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .stat-box {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 15px 30px;
            text-align: center;
        }
        .stat-box .number { font-size: 2rem; font-weight: 800; color: #ce93d8; }
        .stat-box .label { font-size: 0.85rem; color: #888; }

        .search-form {
            text-align: center;
            margin-bottom: 30px;
        }
        .search-form input[type="text"] {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: #e0e0e0;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 1rem;
            width: 300px;
            outline: none;
            font-family: 'Inter', sans-serif;
        }
        .search-form input[type="text"]:focus {
            border-color: #ce93d8;
        }
        .search-form button {
            background: #ce93d8;
            color: #1a1a2e;
            border: none;
            padding: 12px 24px;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-left: 10px;
            font-family: 'Inter', sans-serif;
        }
        .search-form button:hover { background: #e1bee7; }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        .card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .card-color-bar { height: 5px; }
        .card-body { padding: 25px; text-align: center; }
        .card-body img {
            width: 80px; height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid rgba(255,255,255,0.1);
        }
        .card-body h3 { color: #fff; font-size: 1.2rem; margin-bottom: 5px; }
        .card-body .role {
            font-size: 0.85rem;
            font-weight: 600;
            padding: 3px 12px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 12px;
        }
        .card-body .skills { color: #888; font-size: 0.85rem; }
        .card-body .skills span {
            display: inline-block;
            background: rgba(255,255,255,0.05);
            padding: 3px 10px;
            border-radius: 12px;
            margin: 3px;
            font-size: 0.8rem;
        }

        .no-results {
            text-align: center;
            padding: 50px 20px;
            color: #666;
            font-size: 1.1rem;
        }

        .footer {
            text-align: center;
            padding: 30px 20px;
            border-top: 1px solid rgba(255,255,255,0.05);
            color: #555;
            font-size: 0.9rem;
        }

        .todo-notice {
            background: rgba(206, 147, 216, 0.08);
            border: 1px solid rgba(206, 147, 216, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }
        .todo-notice h3 { color: #ce93d8; margin-bottom: 10px; }
        .todo-notice p { color: #b0b0c0; }
    </style>
</head>
<body>

<div class="header">
    <div class="logo-row">
        <img src="https://alaqsa.edu.ps/site/MainPage/Resources/img/logo.png" alt="Al-Aqsa University" style="width:50px;height:50px;border-radius:10px;object-fit:contain;background:#fff;padding:3px;">
        <span style="color:#ccc;font-weight:600;">Al-Aqsa University</span>
    </div>
    <h1>Profile <span>Card Generator</span></h1>
    <p>Week 11 - Task 01: PHP Arrays, Functions & Loops</p>
</div>

<div class="container">

    <!-- TODO 5: Display stats here -->
    <div class="stats">
        <div class="stat-box">
            <div class="number"><?php echo isset($totalPeople) ? $totalPeople : '?'; ?></div>
            <div class="label">Total People</div>
        </div>
        <div class="stat-box">
            <div class="number"><?php echo isset($currentDate) ? $currentDate : '?'; ?></div>
            <div class="label">Current Date</div>
        </div>
    </div>

    <!-- TODO 6: Search form -->
    <form class="search-form" method="GET" action="">
    <input 
    type="text" 
    name="search"
    placeholder="Search by name..."
    value="<?php echo htmlspecialchars($searchQuery ?? ''); ?>">

    <button type="submit">
    Search
    </button>
    </form>

    <!-- TODO 3: Display cards using foreach -->
    <div class="cards-grid">
        <?php if (!empty($people)): ?>
            <?php foreach ($people as $person): ?>
        <?php echo renderCard($person); ?>

<?php endforeach; ?>
        <?php else: ?>
            <div class="no-results">
                <p>No people found. Complete TODO 1 to add data!</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<div class="footer">
    Al-Aqsa University - Web Development 1
</div>

</body>
</html>