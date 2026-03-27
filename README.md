# BookStack for Nextcloud

Integrates [BookStack](https://www.bookstackapp.com/) into Nextcloud's global search. Search your BookStack knowledge base directly from Nextcloud — results open in a new tab.

## Features

- 🔍 BookStack articles appear in Nextcloud's global search
- 🔗 Search results link directly to BookStack (opens in new tab)
- ⚙️ Admin sets the BookStack URL once for all users
- 🔑 Each user configures their own API token in personal settings

## Requirements

- Nextcloud 27–33
- A running BookStack instance reachable from the Nextcloud server
- A BookStack API token per user (Token ID + Token Secret)

## Installation

1. Copy the `bookstack` folder into your Nextcloud `apps/` directory:
   ```bash
   cp -r bookstack /var/www/nextcloud/apps/
   ```

2. Enable the app:
   ```bash
   php occ app:enable bookstack
   ```

3. Allow Nextcloud to make requests to local/internal hosts (required if BookStack runs on an internal IP or hostname):
   ```bash
   php occ config:system:set allow_local_remote_servers --value=true --type=bool
   ```

## Configuration

### Generating a BookStack API Token

1. Log into BookStack
2. Go to your **Profile → API Tokens**
3. Create a new token
4. Copy the **Token ID** and **Token Secret** into the Nextcloud personal settings

## BookStack Configuration

Add to your BookStack `.env`:

```
ALLOW_IFRAME_EMBEDDING=true
```

### Admin (once)

Go to **Settings → Administration → Additional settings** and enter the BookStack URL:

| Field | Description |
|---|---|
| BookStack URL | Base URL of your BookStack instance, e.g. `http://bookstack.example.com` |

### Per user

Each user goes to **Settings → Personal info** and enters their own API token:

| Field | Description |
|---|---|
| API Token ID | Token ID from your BookStack profile |
| API Token Secret | Token Secret from your BookStack profile |

## How it works

The app registers a Nextcloud Search Provider that queries the BookStack REST API (`/api/search`) using each user's personal API token. Results appear alongside other Nextcloud search results and link directly to the corresponding BookStack page in a new tab.

## Technical notes

- Uses PHP 8 Attributes (`#[NoAdminRequired]`) as required by Nextcloud 27+
- Search results are limited to 20 items per query

## License

[AGPL-3.0](LICENSE)
