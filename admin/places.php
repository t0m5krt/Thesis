<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Maps JavaScript API with Places Library Autocomplete Address Field</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Google Maps JavaScript library -->
    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
        })
        ({
            key: "AIzaSyC25TIT6hxQZpsoEU9h89vcPBDa7QRSDHw",
            v: "weekly"
        });
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC25TIT6hxQZpsoEU9h89vcPBDa7QRSDHw&libraries=places&callback=initMap">
    </script>
    <style>
        #search_input {
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 10px;
            margin-top: 50px;
        }

        .form-group label {
            font-size: 18px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-group input:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>
                <h1>Google Maps JavaScript API with Places Library Autocomplete Address Field</h1>
                </p>
                <!-- Autocomplete location search input -->
                <div class="form-group">
                    <label>Location:</label>
                    <input type="text" class="form-control" id="search_input" placeholder="Type address..." />
                </div>
            </div>
        </div>
    </div>
    <script>
        var searchInput = 'search_input';

        $(document).ready(function() {
            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
                types: ['geocode'],
                componentRestrictions: {
                    country: "USA"
                }
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var near_place = autocomplete.getPlace();
            });
        });
    </script>
</body>

</html>