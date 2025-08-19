export class ReleaseGroupSearchResult {
    releaseGroupId: string;
    title: string;
    releaseDate: string;
    type?: string;
    artist: {
        artistName: string;
        artistId: string;
    };
    releases: {
        releaseId: string;
        title: string;
        status: string;
    }[];
    tags: any;
}
