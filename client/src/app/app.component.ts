import { Component, OnInit } from '@angular/core';
import {
    AppTab,
    TAB_ARTISTS,
    TAB_HOME,
    TAB_LABELS,
    TAB_RELEASES,
    TAB_TRACKS,
    TAB_VENUES,
    TAB_LASTFM
} from "../shared/app-tab.type";
import { Observable } from "rxjs";
import { Select } from "@ngxs/store";
import { AppState } from "../shared/app.state";

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {

    activeTab: AppTab;
    home: AppTab = TAB_HOME;
    artist: AppTab = TAB_ARTISTS;
    releases: AppTab = TAB_RELEASES;
    tracks: AppTab = TAB_TRACKS;
    labels: AppTab = TAB_LABELS;
    venues: AppTab = TAB_VENUES;
    lastfm: AppTab = TAB_LASTFM;

    @Select(AppState.getActiveTab) currentTab$: Observable<AppTab>;

    constructor() {
    }

    ngOnInit() {
        this.currentTab$.subscribe(tab => {
            this.activeTab = tab;
        })
    }

}
