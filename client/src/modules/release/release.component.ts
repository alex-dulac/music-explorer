import { Component, OnInit } from '@angular/core';
import { Select, Store } from "@ngxs/store";
import { AppState } from "../../shared/app.state";
import { BehaviorSubject, Observable, Subject } from "rxjs";
import { ApiService } from "@services/api.service";
import { FormBuilder } from "@angular/forms";
import { SetReleaseGroupId, SetReleaseSearchTerm } from "../../shared/app.actions";
import { ReleaseGroupSearchResult } from "@modules/release/models/release-search-result.model";
import { ReleaseGroupDetailsModel } from "@modules/release/models/release-group-details.model";

@Component({
    selector: 'app-release',
    templateUrl: './release.component.html',
    styleUrls: ['./release.component.css']
})
export class ReleaseComponent implements OnInit {

    @Select(AppState.getReleaseGroupId) currentReleaseGroupId$: Observable<string>;
    @Select(AppState.getReleaseSearchTerm) currentReleaseSearchTerm$: Observable<string>;

    releaseGroupLoading: boolean;
    releaseGroupId: string;
    releaseSearchTerm: string;
    releaseGroup$: Subject<ReleaseGroupDetailsModel> = new BehaviorSubject<ReleaseGroupDetailsModel>(null);

    searchLoading: boolean;
    searchBox = this.formBuilder.group({});
    searchResults$: Subject<ReleaseGroupSearchResult[]> = new BehaviorSubject<ReleaseGroupSearchResult[]>(null);
    currentSearchResults: ReleaseGroupSearchResult[];

    constructor(
        private apiService: ApiService,
        private formBuilder: FormBuilder,
        private store: Store
    ) {
    }

    ngOnInit() {
        this.currentReleaseGroupId$.subscribe(id => {
            this.releaseGroupId = id;
        })
        this.currentReleaseSearchTerm$.subscribe(term => {
            this.releaseSearchTerm = term;
        })

        if (this.releaseGroupId) {
            this.viewReleaseGroup(this.releaseGroupId);
            return;
        }
        this.prepareSearchPage();
    }

    prepareSearchPage() {
        this.searchBox = this.formBuilder.group({
            releaseSearchTerm: this.releaseSearchTerm,
        });

        this.searchResults$.subscribe(result => {
            this.currentSearchResults = result;
        });

        // skip the search if there is no search term, or if we already have a batch of results
        if (this.releaseSearchTerm != '' && (
            this.currentSearchResults === null || 
            this.currentSearchResults === undefined || 
            this.currentSearchResults?.length < 1
        )) {
            this.searchReleaseGroup();
        }
    }

    clear() {
        this.store.dispatch(new SetReleaseSearchTerm(''));
        this.searchBox.setValue({releaseSearchTerm: ''});
    }

    searchReleaseGroup(): void {
        this.searchLoading = true;
        const userEntry = this.searchBox.value.releaseSearchTerm;

        if (userEntry === '' || userEntry === 'undefined') {
            this.releaseSearchTerm = ''; // this is just to overwrite 'undefined' if that is the case
            this.store.dispatch(new SetReleaseSearchTerm(''));
            this.searchLoading = false;
            return;
        }

        this.apiService.searchReleaseGroup(userEntry).subscribe((data) => {
            this.searchResults$.next(data);
            this.store.dispatch(new SetReleaseSearchTerm(userEntry));
            this.searchLoading = false;
        });
    }

    viewReleaseGroup(releaseGroupId: string) {
        this.releaseGroupLoading = true;
        this.releaseGroupId = releaseGroupId;
        this.store.dispatch(new SetReleaseGroupId(releaseGroupId));

        this.apiService.getReleaseGroup(releaseGroupId).subscribe((data) => {
            this.releaseGroupLoading = false;
            this.releaseGroup$.next(data);
        });
    }

    back() {
        this.store.dispatch(new SetReleaseGroupId(''));
        this.releaseGroupId = null;
        this.prepareSearchPage();
    }
}
