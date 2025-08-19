import { Component, OnInit } from '@angular/core';
import { Select } from "@ngxs/store";
import { AppState } from "../../shared/app.state";
import { Observable } from "rxjs";

@Component({
    selector: 'app-lastfm',
    templateUrl: './lastfm.component.html',
    styleUrls: ['./lastfm.component.scss']
})
export class LastFmComponent implements OnInit {

    @Select(AppState.getArtistId) currentArtistId$: Observable<string>;
    activeArtistId: string;

    constructor() {
    }

    ngOnInit(): void {
        this.currentArtistId$.subscribe(data => {
            this.activeArtistId = data;
        })
    }

}
