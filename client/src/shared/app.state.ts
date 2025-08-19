import {AppTab, TAB_HOME} from "./app-tab.type";
import {Action, Selector, State, StateContext} from "@ngxs/store";
import {
    ResetState,
    SetActiveTab,
    SetArtistId,
    SetArtistSearchTerm,
    SetReleaseGroupId,
    SetReleaseSearchTerm,
    SetScrobblingEnabled
} from "./app.actions";
import {Injectable} from "@angular/core";

export interface AppStateModel {
    activeTab: AppTab;
    artistSearchTerm: string;
    artistId: string;
    releaseSearchTerm: string;
    releaseGroupId: string;
    scrobblingEnabled: boolean;
}

@State<AppStateModel>({
    name: 'app',
    defaults: {
        activeTab: TAB_HOME,
        artistSearchTerm: '',
        artistId: '',
        releaseSearchTerm: '',
        releaseGroupId: '',
        scrobblingEnabled: false,
    }
})

@Injectable({
    providedIn: 'root'
})

export class AppState {
    @Selector()
    static getActiveTab(state: AppStateModel): AppTab {
        return state.activeTab;
    }

    @Action(SetActiveTab)
    setActiveTab({ patchState }: StateContext<AppStateModel>, { payload }: SetActiveTab) {
        patchState({ activeTab: payload });
    }

    @Selector()
    static getArtistId(state: AppStateModel): string {
        return state.artistId;
    }

    @Action(SetArtistId)
    setArtistId({ patchState }: StateContext<AppStateModel>, { payload }: SetArtistId) {
        patchState({ artistId: payload });
    }

    @Selector()
    static getArtistSearchTerm(state: AppStateModel): string {
        return state.artistSearchTerm;
    }

    @Action(SetArtistSearchTerm)
    setArtistSearchTerm({ patchState }: StateContext<AppStateModel>, { payload }: SetArtistSearchTerm) {
        patchState({ artistSearchTerm: payload });
    }

    @Selector()
    static getReleaseGroupId(state: AppStateModel): string {
        return state.releaseGroupId;
    }

    @Action(SetReleaseGroupId)
    setReleaseGroupId({ patchState }: StateContext<AppStateModel>, { payload }: SetReleaseGroupId) {
        patchState({ releaseGroupId: payload });
    }

    @Selector()
    static getReleaseSearchTerm(state: AppStateModel): string {
        return state.releaseSearchTerm;
    }

    @Action(SetReleaseSearchTerm)
    setReleaseSearchTerm({ patchState }: StateContext<AppStateModel>, { payload }: SetReleaseSearchTerm) {
        patchState({ releaseSearchTerm: payload });
    }

    @Selector()
    static getScrobblingEnabled(state: AppStateModel): boolean {
        return state.scrobblingEnabled;
    }

    @Action(SetScrobblingEnabled)
    setScrobblingEnabled({ patchState }: StateContext<AppStateModel>, { payload }: SetScrobblingEnabled) {
        patchState({ scrobblingEnabled: payload });
    }

    @Action(ResetState)
    resetState({ setState }: StateContext<AppStateModel>) {
        setState({
            activeTab: TAB_HOME,
            artistSearchTerm: '',
            artistId: '',
            releaseSearchTerm: '',
            releaseGroupId: '',
            scrobblingEnabled: false
        });
    }
}
