# music-explorer

A PHP backend / Angular frontend application to lookup and pull data related to musical artists, records, etc from third-party APIs.

### Third-Party APIs that this app utilizes:

- MusicBrainz (https://musicbrainz.org/doc/MusicBrainz_API)
- MediaWiki (https://www.mediawiki.org/wiki/API:Main_page)
- LastFm (https://www.last.fm/api)
- Apple Music API (https://developer.apple.com/documentation/applemusicapi/)

## How To Use (Docker):

- Install Docker
- Copy the `.env.example` file in the server directory and populate your own details.
  - `cd server && cp .env.example .env && cd ..`
- In the project root, run `docker compose up` (use -d to run in background)

## How To Use (non-Docker):

- Make sure php and angular are installed on your machine.
- Download the source code.
- Install dependencies.
- In a terminal window, navigate to the root of the project and run command `php artisan serve` to run the PHP application.
- In a separate terminal window/tab, navigate to `/frontend/src/app` and run command `ng serve` to run the Angular Application.
- Open a browser window and navigate to `http://localhost:4200/`
