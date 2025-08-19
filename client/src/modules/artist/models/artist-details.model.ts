import {ArtistLinksModel} from "@modules/artist/models/artist-links.model";

export class ArtistDetailsModel {
    id: string;
    name: string;
    country: string;
    city: string;
    disambiguation: string;
    artistType: string;
    links: Array<ArtistLinksModel> = [];
    wikiTitle: string;
    wikiIntro: string;
    lastFmUrl: string;
    lastFmListenerCount: string;
    lastFmPlayCount: string;
    onTour: boolean;
    establishedYear?: string;
    disbandedYear?: string;
    disbanded?: boolean;
}
