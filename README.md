# Portfolio Manager Plugin

## Beschrijving
Deze plugin maakt het mogelijk om portfolio projecten aan te maken, beheren en tonen op een WordPress website.  
Gebruik een shortcode `[portfolio_projects]` om projecten in een grid te tonen met titel, afbeelding, korte beschrijving en link.  
Filteren kan met parameters zoals `category` en `order`.

## Installatie
1. Upload de map `portfolio-manager` naar de map `/wp-content/plugins/` van je WordPress installatie.
2. Activeer de plugin via het WordPress admin dashboard onder Plugins.
3. Voeg projecten toe via het nieuwe menu 'Projecten'.
4. Plaats de shortcode `[portfolio_projects]` op een pagina om je projecten te tonen.

## Gebruik
- Maak nieuwe projecten aan via het Projecten-menu.
- Vul de metaboxen in met beschrijving, technologieën, externe link en opleverdatum.
- Gebruik shortcode filters zoals `[portfolio_projects category="webdesign" order="desc"]`.

## Veelgestelde vragen
*Verwijdert de plugin mijn projecten bij de-installatie?**  
Nee, de projecten blijven bewaard in de database.

## Changelog
### 1.0
- Eerste versie met custom post type, metaboxen en shortcode functionaliteit.

## Credits
Gemaakt door [Ahmad Eknan] als stageopdracht.

