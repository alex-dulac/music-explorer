import {Component, OnInit} from '@angular/core';
import {Select} from "@ngxs/store";
import {AppState} from "../../shared/app.state";
import {Observable} from "rxjs";

@Component({
    selector: 'app-home',
    templateUrl: './home.component.html',
    styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

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
