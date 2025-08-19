import { Component, OnInit } from '@angular/core';
import {
    AppTab,
    TAB_ARTISTS,
    TAB_HOME,
    TAB_LABELS,
    TAB_RELEASES,
    TAB_LASTFM,
    TAB_TRACKS, TAB_VENUES
} from "../../shared/app-tab.type";
import { Select, Store } from "@ngxs/store";
import { ResetState, SetActiveTab } from "../../shared/app.actions";
import { AppState } from "../../shared/app.state";
import { Observable } from "rxjs";

declare interface SidebarLink {
    type: AppTab;
    title: string;
    singular?: string;
}

export const ROUTES: SidebarLink[] = [
    { type: TAB_HOME, title: 'Home' },
    { type: TAB_ARTISTS, title: 'Artists', singular: 'artist' },
    { type: TAB_RELEASES, title: 'Releases', singular: 'release'  },
    // { type: TAB_TRACKS, title: 'Tracks', singular: 'track'  }, // recordings
    // { type: TAB_LABELS, title: 'Labels', singular: 'label'  },
    // { type: TAB_VENUES, title: 'Venues', singular: 'venue'  }, // places
    { type: TAB_LASTFM, title: 'LastFM', singular: 'lastfm'  },
];

@Component({
    selector: 'app-sidebar',
    templateUrl: './sidebar.component.html',
    styleUrls: ['./sidebar.component.scss']
})
export class SidebarComponent implements OnInit {
    sidebarLinks: SidebarLink[];
    activeTab: AppTab;
    @Select(AppState.getActiveTab) currentTab$: Observable<AppTab>;

    constructor(private store: Store) {
    }

    ngOnInit() {
        this.sidebarLinks = ROUTES.filter(sidebarLink => sidebarLink);
        this.currentTab$.subscribe(tab => {
            this.activeTab = tab;
        })
    }

    changeActiveTab(tab: AppTab) {
        this.store.dispatch(new SetActiveTab(tab));
    }

    resetState(): void {
        this.store.dispatch(new ResetState());
    }
}
