import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from "@angular/common/http";
import { Observable } from "rxjs";
import { ArtistSearchResult } from "@modules/artist/models/artist-search-result.model";
import { ArtistDetailsModel } from "@modules/artist/models/artist-details.model";
import { ReleaseGroupSearchResult } from "@modules/release/models/release-search-result.model";
import { ReleaseGroupDetailsModel } from "@modules/release/models/release-group-details.model";

@Injectable({
    providedIn: 'root'
})
export class ApiService {

    baseUrl: string = 'http://0.0.0.0:8000/api';

    constructor(
        private http: HttpClient
    ) {
    }

    searchArtist(searchTerm: string): Observable<ArtistSearchResult[]> {
        let params = new HttpParams();
        params = params.set('searchTerm', searchTerm);
        return this.http.get<ArtistSearchResult[]>(this.baseUrl + '/Artists/search', {params: params});
    }

    getArtist(artistId: string): Observable<ArtistDetailsModel> {
        let params = new HttpParams();
        params = params.set('artistId', artistId);
        return this.http.get<ArtistDetailsModel>(this.baseUrl + '/Artists/get', {params: params});
    }

    searchReleaseGroup(searchTerm: string): Observable<ReleaseGroupSearchResult[]> {
        let params = new HttpParams();
        params = params.set('searchTerm', searchTerm);
        return this.http.get<ReleaseGroupSearchResult[]>(this.baseUrl + '/Releases/searchReleaseGroup', {params: params});
    }

    getReleaseGroup(releaseGroupId: string): Observable<ReleaseGroupDetailsModel> {
        let params = new HttpParams();
        params = params.set('releaseGroupId', releaseGroupId);
        return this.http.get<ReleaseGroupDetailsModel>(this.baseUrl + '/Releases/getReleaseGroup', {params: params});
    }

}
